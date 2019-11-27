@extends('frontEnd.master')

@section('title')
    Ecommerce|Cart
    @endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(frontAsset/images/shopping.jpeg);">
        <h2 class="l-text2 t-center">
            Cart
        </h2>
    </section>

    <!-- Cart -->
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
            <h3 style="text-align: center" class="text-success" >{{ Session::get('mess') }}</h3>

            <!-- Cart item -->
            <div class="container-table-cart pos-relative">
                <div class="wrap-table-shopping-cart bgwhite">
                    <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-4 p-l-70">Quantity</th>
                            <th class="column-5">Total</th>
                            <th class="column-5">Remove</th>
                        </tr>
                        @foreach($cartProducts as $cartProduct)
                        <tr class="table-row">
                            <td class="column-1">
                                <div class="cart-img-product b-rad-4 o-f-hidden">
                                    <img src="{{asset($cartProduct->attributes->ItemImage)}}" alt="IMG-PRODUCT">
                                </div>
                            </td>
                            <td class="column-2">{{$cartProduct->name}}</td>
                            <td class="column-3">${{$cartProduct->price}}</td>
                            <td class="column-4">
                                <form  method="post" action="{{url('/update-cart')}}">
                                    {{csrf_field()}}
                                <div class="flex-w bo5 of-hidden w-size17">
                                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                    </button>

                                    <input class="size8 m-text18 t-center num-product" type="number" name="quantity" value="{{$cartProduct->quantity}}">

                                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>

                                    </button>


                                </div>
                                <div class="flex-w bo5 of-hidden w-size17">
                                    <input type="hidden" name="id" value="{{$cartProduct->id}}">
                                    <input type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="Update">

                                </div>
                                </form>

                            </td>
                            <td class="column-5">${{$cartProduct->price*$cartProduct->quantity}}</td>
                            <td class="column-5">
                                <a href="{{url('/remove-from-cart/'.$cartProduct->id)}}" ><i class="fs-12 fa fa-times" aria-hidden="true"></i></a>

                            </td>
                        </tr>
@endforeach
                        </table>
                </div>
            </div>

<form action="{{url('/confirm-order')}}" method="post">
    {{csrf_field()}}
            <!-- Total -->
            <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                <h5 class="m-text20 p-b-24">
                    Cart Totals
                </h5>

                <!--  -->
                <div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

                    <span class="m-text21 w-size20 w-full-sm">
						${{Cart::getSubTotal()}}
					</span>
                </div>
                <div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						TAX:
					</span>

                    <span class="m-text21 w-size20 w-full-sm">
						${{Cart::getSubTotal()*.15}}(15%)
					</span>
                </div>

                <!--  -->
                <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Shipping:
					</span>

                    <div class="w-size20 w-full-sm">
                        <p class="s-text8 p-b-23">
                            There are no shipping methods available. Please double check your address, or contact us if you need any help.
                        </p>

                        <span class="s-text19">
							Calculate Shipping
						</span>

                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
                            <span style="color: red;">{{ $errors->has('state') ? $errors->first('state') : ' ' }}</span>
                        </div>

                        <div class="size13 bo4 m-b-22">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
                            <span style="color: red;">{{ $errors->has('postcode') ? $errors->first('postcode') : ' ' }}</span>
                        </div>
                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="address" placeholder="Address">
                            <span style="color: red;">{{ $errors->has('address') ? $errors->first('address') : ' ' }}</span>
                        </div>
                        <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="phone" placeholder="Mobile Number">
                            <span style="color: red;">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Payment:
					</span>

                    <span class="m-text21 w-size20 w-full-sm">
						<input type="radio" name="payment" value="cash"> Cash On Delivery<br>
						<input type="radio" name="payment" value="bkash" > Bikash
					</span>
                    <span style="color: red;">{{ $errors->has('payment') ? $errors->first('payment') : ' ' }}</span>

                </div>
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

                    <span class="m-text21 w-size20 w-full-sm">
						${{ Cart::getTotal()+Cart::getTotal()*.15}}
					</span>
                </div>

                <div class="size15 trans-0-4">
                    <!-- Button -->
                    <input type="submit" value=" Proceed to Checkout" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                </div>
            </div>
</form>
        </div>
    </section>


@endsection