@extends('frontEnd.master')

@section('title')
    Ecommerce | Product Details
    @endsection

@section('content')

    <!-- breadcrumb -->
    <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
        <a href="{{url('/')}}" class="s-text16">
            Home
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="#" class="s-text16">
            {{$productDetails->category_name}}
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
			{{$productDetails->product_name}}
		</span>
    </div>

    <!-- Product Detail -->
    <div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        <div class="item-slick3" data-thumb="{{asset($productDetails->product_image)}}">
                            <div class="wrap-pic-w">
                                <img src="@if(isset($productDetails->product_image)){{asset($productDetails->product_image)}}@else frontAsset/images/noImage.png @endif "  alt="IMG-PRODUCT">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset($productDetails->product_image2==null? 'frontAsset/images/noImage.png':$productDetails->product_image2)}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset($productDetails->product_image2==null? 'frontAsset/images/noImage.png':$productDetails->product_image2)}}" alt="IMG-PRODUCT">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset($productDetails->product_image3==null? 'frontAsset/images/noImage.png':$productDetails->product_image3)}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset($productDetails->product_image3==null? 'frontAsset/images/noImage.png':$productDetails->product_image3)}}" alt="IMG-PRODUCT">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <h4 class="product-detail-name m-text16 p-b-13">
                 <b>  {{$productDetails->product_name}}</b>
                </h4>

                <span class="m-text17">
					৳ {{$productDetails->product_price}}
				</span>

                <p class="s-text8 p-t-10">
                   {{$productDetails->short_description}}
                </p>
                <div class="p-t-33 p-b-60">



                    <div class="flex-r-m flex-w p-t-10">
                        <div class="w-size16 flex-m flex-w">
                            <form action="{{url('/add-cart-from-details')}}" method="Post">
                                {{csrf_field()}}
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="quantity" value="1">


                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>


                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                @if(Auth::user()->role=='user')
                                <input  type="hidden" name="id" value="{{$productDetails->id}}">
                                <input class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" value="Add to Cart">
                                @endif
                            </div>
                                <span style="color: red;">{{ $errors->has('quantity') ? $errors->first('quantity') : ' ' }}</span>
                                <span style="color: red;">{{ $errors->has('id') ? $errors->first('id') : ' ' }}</span>
                            </form>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="p-b-45">
                  <span class="s-text8 m-r-35">Product Code:  <b> {{$productDetails->product_code}}</b></span>
                    <span class="s-text8">Categories: <b>{{$productDetails->category_name}}</b></span><br>
                    <span class="s-text8 m-r-35">Brand Name: <b>{{$productDetails->brand_name}}</b></span>
                    <span class="s-text8">Available Quantity: <b>{{$productDetails->product_quantity}}</b></span>

                </div>
                <div class="p-b-45">
                  </div>
                <!--  -->
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Description
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            {{$productDetails->long_description}}
                        </p>
                    </div>
                </div>

             </div>
        </div>
    </div>


    <!-- Relate Product -->
    <section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
            <div class="sec-title p-b-60">
                <h3 class="m-text5 t-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach($relatedProducts->RelatedProduct($productDetails->category_id) as $relatedProduct)
                        <div class="item-slick2 p-l-15 p-r-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                <img src="{{asset($relatedProduct->product_image)}}" height="360px" width="260px" style="border: 1px solid #CCCCCC" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4" style="border: 1px solid black">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                        @if(Auth::user()->role=='user')
                                        <a href="{{url('/add-product-cart/'.$relatedProduct->id)}}">
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20" style="border: 1px solid #CCCCCC; text-align: center">
                                <a href="{{url('/product-details/'.$relatedProduct->id)}}" class="block2-name dis-block s-text3 p-b-5">
                                    {{$relatedProduct->product_name}}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
									৳ {{$relatedProduct->product_price}}
								</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

@endsection