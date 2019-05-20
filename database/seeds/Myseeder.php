<?php

use App\Customer;
use App\Product ;
use App\Order ;
use App\OrderDetail;

use App\User;
use Illuminate\Database\Seeder;

class Myseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create(['name'=>'alex','email'=>'alexander@maina.com','password'=>bcrypt('secret')]);

        $c1=Customer::create(['name'=>'Alexander Maina','phone'=>'0712186368','address'=>'Nairobi']);
        $c2=Customer::create(['name'=>'Theo Walcott','phone'=>'0712186985','address'=>'London']);
        $p1= Product::create(['name'=>'Cement','quantity'=>100,'price'=>400]);
        $p2= Product::create(['name'=>'Nails Pack','quantity'=>300,'price'=>300]);
        $p3= Product::create(['name'=>'Paint','quantity'=>150,'price'=>450]);
        $p4= Product::create(['name'=>'Tiles Pack','quantity'=>500,'price'=>700]);

        $order1=Order::create(['customer_id'=>1,'total'=>4000]);
        $order2=Order::create(['customer_id'=>2,'total'=>1000]);
        $order3=Order::create(['customer_id'=>1,'total'=>4450]);

        $d1=OrderDetail::create(['order_id'=>1,'product_id'=>2,'quantity'=>2,'amount'=>4000]);
        $d1=OrderDetail::create(['order_id'=>2,'product_id'=>1,'quantity'=>3,'amount'=>3000]);
        $d1=OrderDetail::create(['order_id'=>3,'product_id'=>4,'quantity'=>1,'amount'=>4000]);

    }
}
