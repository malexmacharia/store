<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login']]);
    }
    public function create_customer(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:5',
            'phone'=>'required|regex:/(^(\+2547)[0-9]{8}$)/u',
            'address'=>'required',
            'email'=>'required'
        ]);
        if ($validator->fails())
            {
            return $this->sendResponse($validator->errors(),422);
            }
            $customer=Customer::create($request->all());
            return $this->sendResponse($customer,200,true);

    }

    public function create_order(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'customer_id'=>'required|integer',
            'user_id'=>'required|exists:users,id',
        ]);
        if ($validator->fails())
        {
            return $this->sendResponse($validator->errors(),422);
        }

        $order=Order::create([
            'customer_id'=>$request->customer_id,
            'total'=>0,
            'user_id'=>$request->user_id,
        ]);
        return $this->sendResponse($order,200,true);
    }

    public function get_customers()
    {
        $customers=Customer::all();
        return $this->sendResponse($customers,200,true);
    }

    public function get_orders()
    {
        $order=Order::all();
        return $this->sendResponse($order,200,true);
    }

    public function delete_order($id)
    {
        //$id=$request->order_id;
        $order=Order::find($id);
        $user = Auth::user();
        if ($user->can('delete',$order)) {
            Order::destroy($id);
            return $this->sendResponse('Deleted', 200, true);
        }
        else
            {
                return $this->sendResponse('Unauthorized', 401, false);
            }

    }

    private function sendResponse($data,$code,$success=false)
    {
      $response=[
        'success'=>$success,
        'body'=>$data
      ];
      return response()->json($response,$code);
    }
    //gtant_type
    //client_id
   //client_secret
    //username
    //password
    public function login(Request $request)
    {
        //$user=User::where(['id'=>$request->id,'password'=>($request->password)])->first();
        $user=User::where(['id'=>$request->id])->first();
        if ($user)
        {
            $token = $user->createToken('Store')->accessToken;
            return $this->sendResponse($token,200,true);
        }
        else
        {
            return $this->sendResponse('Wrong Credentials',401);
        }
    }
}
