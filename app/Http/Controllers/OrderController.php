<?php

namespace App\Http\Controllers;

use App\DeliveryManOnOrder;
use App\Order;
use App\OrderDetails;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function makeOrder(Request $request){
        $this->validate($request, [
            'state'=>'required',
            'postcode'=>'required',
            'address'=>'required',
            'payment'=>'required',
            'phone'=>'required',

        ]);
        $order=new Order();
        $order->user_id=Auth::user()->id;
        $order->state=$request->state;
        $order->post_code=$request->postcode;
        $order->address=$request->address;
        $order->phone=$request->phone;
        $order->payment_type=$request->payment;
        $order->total_order_cost=Cart::getTotal()+Cart::getTotal()*.15;
        $order->status=0;
        $order->save();

        $orderID=$order->id;

        foreach (Cart::getContent() as $item){
            $orderDetails=new OrderDetails();
            $orderDetails->order_id=$orderID;
            $orderDetails->product_id=$item->id;
            $orderDetails->net_price=$item->price;
            $orderDetails->total_amount=$item->price*$item->quantity;
            $orderDetails->quantity=$item->quantity;
            $orderDetails->product_discount=$item->attributes->discount;
            $orderDetails->save();

            Product::where('id',$item->id)->decrement('product_quantity',$item->quantity);
        }
        Cart::clear();
        return back()->with('mess','You have successfully order your product!');

    }
    public function myOrders(){
        $myOrders=Order::where('user_id',Auth::user()->id)->get();

        return view('frontEnd.home.my-order',['myOrders'=>$myOrders]);
    }
    public function trackOrder(){
        $myOrders=Order::where('user_id',Auth::user()->id)->get();

        return view('frontEnd.home.tracking',['myOrders'=>$myOrders]);
    }
    public function setDeliveryManOnOrder(){

        $deliveryManOnOrder=DB::table('delivery_man_on_orders')
            ->join('users','users.id','=','delivery_man_on_orders.delivery_man_id')
            ->select('users.name','delivery_man_on_orders.*')
            ->orderBy('delivery_man_on_orders.created_at','desc')
            ->get();

        return view('admin.Delivery.setDeliveryman',['deliveryManOnOrder'=>$deliveryManOnOrder]);
    }
    public function saveAllocation(Request $request){
        $delivery=new DeliveryManOnOrder();
        $delivery->order_id=$request->order_id;
        $delivery->delivery_man_id=$request->deliveryman_id;
        $delivery->save();
        return back();
    }
    public function SearchOrder(Request $request){

        $check=DB::table('orders')
            ->where('id','=',$request->order_id)
            ->where('user_id','=',Auth::user()->id)
            ->where('status','=',0)
            ->count();
        if ($check<1){
            echo ('Please insert Valid Order Number!');
        }else{
            $deliveryManId=DeliveryManOnOrder::where('order_id',$request->order_id)->first();

            if (!isset($deliveryManId->delivery_man_id)){
                echo "not set";
                //return back()->with('mess','No delivery man is still allocated!please try after sometime!!');
            }else{


                $currentLocation=DB::table('location_histories')
                    ->select('location_histories.latitude','location_histories.longtitude')
                    ->where('delivery_man_id','=',$deliveryManId->delivery_man_id)
                    ->latest()
                    ->first();

                //dd($currentLocation);
                print json_encode($currentLocation);
                //return view('frontEnd.home.tracking',['currentLocation'=>$currentLocation]);
            }

        }


    }
    public function SearchMyOrder(Request $request){

        $currentLocation=DB::table('location_histories')
            ->select('*')
            ->get();
        //dd($currentLocation);
        print json_encode($currentLocation);

    }
}
