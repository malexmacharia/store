<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Customer;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSmsJob;
use App\Mail\OrderMail;
use App\OrderDetail;
use App\Payment;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Order;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Safaricom\Mpesa\Mpesa;


class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $orders=Order::orderBy('id','DESC')->get();
        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $customers= Customer::all();
        return view('orders.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
           'customer_id'=>'required|integer'
        ]);
        $order=Order::create([
            'customer_id'=>$request->customer_id,
            'total'=>0,
            'user_id'=>Auth::user()->id
             ]);
        $customer=Customer::FindorFail($request->customer_id);
        //        $email = new OrderMail($order,$customer);
//        Mail::to('malexmacharia@gmail.com') ->send($email);
        //$this->dispatch(new SendEmailJob($order,$customer));

        //$message='Dear '.$customer->name.' Your Order Number #'.$order->id.' has been Dispatched';
        #$this->sms($customer->phone,$message);
        //$this->dispatch(new SendSmsJob($customer->phone,$message));
        $this->pay($order->id);
        return redirect()->route('orders.index')->with('success','Orders Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $order=Order::FindorFail($id);
        $products=Product::all();
        return view('orders.update',compact('order','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
           'quantity'=>'required|integer']);
        $order = Order::findorfail($id);

        $product=Product::find($request->product_id);
        $order->total +=$product->price* $request->quantity;
        $order->save();

        OrderDetail::create([
            'order_id'=>$id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'amount'=>$product->price * $request->quantity
        ]);
       return back() ->with('Success','Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
     $order=Order::FindorFail($id);
     $order->delete();
     return back()->with('Success','Order Deleted');

    }

    public function pay($order_id)
    {
        $mpesa=new Mpesa();
        $BusinessShortCode='174379';
        $LipaNaMpesaPasskey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType='CustomerPayBillOnline';
        $Amount='1';
        $PartyA='254712186368';
        $PartyB='174379';
        $PhoneNumber='254712186368';
        $CallBackURL='http://f4c180cd.ngrok.io/mpesa/confirm';
        $AccountReference='Testing';
        $TransactionDesc='Testing';
        $Remarks='Testing';

        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType,
                             $Amount, $PartyA, $PartyB,
                            $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);
        $merchant_id=json_decode($stkPushSimulation)->MerchantRequestID;
        Payment::create([
            'order_id'=>$order_id,
            'merchant_id'=>$merchant_id,
            'date_paid'=>Carbon::now()
        ]);
       // dd($stkPushSimulation);
    }
}
