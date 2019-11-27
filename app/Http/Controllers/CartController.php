<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function showCart(){
        $cartProducts=Cart::getContent();


        return view('frontEnd.cart.cart-content',['cartProducts'=>$cartProducts]);
    }
    public function showCheckout(){

        $cartProducts=cart::instance('shopping')->content();
        if(session()->get('brand_product')){
            foreach ($cartProducts as $cartProduct) {

                $stockQty = DB::table('brand_products')
                    ->select('product_quantity','product_sell_number')
                    ->where('id', '=', $cartProduct->id)
                    ->first();
                if ($cartProduct->qty > $stockQty->product_quantity) {
                    return redirect('/cart-content')->with('messageDanger', 'Quantity is out of Stock!! Please check products available quantity');
                }
                if($cartProduct->qty < $stockQty->product_sell_number){
                    return redirect('/cart-content')->with('messageDanger', 'Quantity can not be less than minimum selling amount');
                }
            }
            $OldShippingAddress=DB::table('shippings')
                ->join('orders','orders.shipping_id','=','shippings.id')
                ->select('shippings.*')
                ->where('orders.customer_id','=',Auth::user()->id)
                ->latest()
                ->first();
        }else {
            foreach ($cartProducts as $cartProduct) {

                $stockQty = DB::table('products')
                    ->select('product_quantity')
                    ->where('id', '=', $cartProduct->id)
                    ->first();
                if ($cartProduct->qty > $stockQty->product_quantity) {
                    return redirect('/cart-content')->with('messageDanger', 'Quantity is out of Stock!! Please check products available quantity');
                }
            }
            $OldShippingAddress=DB::table('shippings')
                ->join('order_customers','order_customers.shipping_id','=','shippings.id')
                ->select('shippings.*')
                ->where('order_customers.customer_id','=',Auth::user()->id)
                ->latest()
                ->first();
        }


        return view('font.checkout.checkout-content',['cartProducts'=>$cartProducts,'OldShippingAddress'=>$OldShippingAddress]);
    }
    public function addToCart($id){
        $brandItems=Product::find($id);
        if($brandItems->product_quantity<1){
            return redirect('/product-details/'.$id)->with('message','Your selected product is out of stock');

        }else {

                Cart::add([
                    'id' => $id,
                    'name' => $brandItems->product_name,
                    'price' => $brandItems->product_price-($brandItems->product_price*$brandItems->product_discount/100),
                    'quantity' => 1,
                    'attributes' => [
                        'ItemCode' => $brandItems->product_code,
                        'discount' => $brandItems->product_discount,
                        'ItemImage' => $brandItems->product_image,
                        'ItemStock' => $brandItems->product_quantity,
                    ]
                ]);

        }
        return redirect('/cart-content');

    }
    public function addToCartFromDetails(Request $request){

        $brandItems=Product::find($request->id);

        if($brandItems->product_quantity < $request->quantity){

            return redirect('/product-details/'.$request->id)->with('message','Your selected product is out of stock');

        }else {

            Cart::add([
                'id' => $request->id,
                'name' => $brandItems->product_name,
                'price' => $brandItems->product_price-($brandItems->product_price*$brandItems->product_discount/100),
                'quantity' => $request->quantity,
                'attributes' => [
                    'ItemCode' => $brandItems->product_code,
                    'discount' => $brandItems->product_discount,
                    'ItemImage' => $brandItems->product_image,
                    'ItemStock' => $brandItems->product_quantity,
                ]
            ]);

        }
        return redirect('/cart-content');
    }
    public function updateCartById(Request $request){
        $product=Product::find($request->id);
        $cartQty=Cart::get($request->id);
        $cartQty=$cartQty->quantity;
        $totalQty=$cartQty+$request->quantity;

        $quantity=$product->product_quantity;
//dd($request->id);
        if($quantity<$totalQty){
            Cart::update($request->id, [ 'quantity' => [
                'relative' => false,
                'value' => $quantity,
            ]]);
            return redirect('/cart-content')->with('messageDanger', 'Your Expected Quantity is Out Of Stock');
        }else {
            Cart::update($request->id, [ 'quantity' => [
                'relative' => false,
                'value' => $request->quantity,
            ]]);
            return redirect('/cart-content')->with('message', 'Cart product info update successfully');

        }
    }
    public function removeCartById($id){

        Cart::remove($id);

        return redirect('/cart-content');
    }

}
