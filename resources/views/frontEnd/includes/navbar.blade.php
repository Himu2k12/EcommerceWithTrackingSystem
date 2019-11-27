
<!-- Menu -->
<div class="wrap_menu">
    <nav class="menu">
        <ul class="main_menu">
            <li>
                <a class="{!! Request::is('/') ? 'sale-noti':'' !!}" href="{{url('/')}}">Home</a>

            </li>

            <li>
                <a href="{{url('/my-order')}}">My Order</a>
            </li>

            @if(isset(Auth::user()->id) && Auth::user()->role=="admin")
                <li>
                    <a href="{{url('/admin-view')}}">Admin</a>
                </li>
            @endif
            <li>
                <a href="{{url('/order-tracking')}}">Tracking</a>
            </li>
            @if(!isset(Auth::user()->id))
                <li>
                    <a href="{{url('/login')}}">Login</a>
                </li>
                <li>
                    <a href="{{url('/register')}}">Register</a>
                </li>
            @else
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </nav>
</div>

<!-- Header Icon -->
<div class="header-icons">
    <a href="#" class="header-wrapicon1 dis-block">
        <img src="{{asset('/frontAsset/')}}/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
    </a>

    <span class="linedivide1"></span>

    <div class="header-wrapicon2">
        <img src="{{asset('/frontAsset/')}}/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
        <span class="header-icons-noti">{{Cart::getContent()->count()}}</span>

        <!-- Header cart noti -->
        <div class="header-cart header-dropdown">
            <ul class="header-cart-wrapitem">
                @foreach(Cart::getContent() as $item)
                    <li class="header-cart-item">
                        <div class="header-cart-item-img">
                            <img src="{{asset($item->attributes->ItemImage)}}" height="80px" width="80px" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name">
                                {{$item->name}}
                            </a>

                            <span class="header-cart-item-info">
                                {{$item->quantity}} x ${{$item->price}}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="header-cart-total">
                Total: ${{Cart::getTotal()}}
            </div>

            <div class="header-cart-buttons">
                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="{{url('/cart-content')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        View Cart
                    </a>
                </div>

                <div class="header-cart-wrapbtn">
                    <!-- Button -->
                    <a href="{{url('/cart-content')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Header -->
<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
            <div class="topbar-social">
                <a href="#" class="topbar-social-item fa fa-facebook"></a>
                <a href="#" class="topbar-social-item fa fa-instagram"></a>
                <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
            </div>

            <!-- Logo2 -->
            <a href="{{url('/')}}" class="logo2" style="text-decoration:none;">
                <h2>Online Order Tracking System</h2>
            </a>

            <div class="topbar-child2">
					<span class="topbar-email">
						@if(isset(Auth::user()->id))
                            {{Auth::user()->name}}
                        @endif
					</span>


                <!--  -->
                <a href="{{url('/')}}" class="header-wrapicon1 dis-block m-l-30">
                    <img src="{{asset('/frontAsset/')}}/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-13">

                    <img src="{{asset('/frontAsset/')}}/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{Cart::getContent()->count()}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            @foreach(Cart::getContent() as $item)
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{asset($item->attributes->ItemImage)}}" height="80px" width="80px" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            {{$item->name}}
                                        </a>

                                        <span class="header-cart-item-info">
											{{$item->quantity}} x ৳ {{$item->price}}
										</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="header-cart-total">
                            Total: ৳{{Cart::getTotal()}}
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{url('/cart-content')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{url('/cart-content')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap_header">

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a  href="{{url('/')}}">Home</a>
                        </li>

                        <li>
                            <a href="{{url('/my-order')}}">My Order</a>
                        </li>

                        @if(isset(Auth::user()->id) && Auth::user()->role=="admin")
                            <li>
                                <a href="{{url('/admin-view')}}">Admin</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{url('/order-tracking')}}">Tracking</a>
                        </li>
                        @if(!isset(Auth::user()->id))
                            <li>
                                <a href="{{url('/login')}}">Login</a>
                            </li>
                            <li>
                                <a href="{{url('/register')}}">Register</a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">

            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{url('/')}}" class="logo-mobile" style="text-decoration:none;">
            <h2>Online Order Tracking System</h2>
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <a href="#" class="header-wrapicon1 dis-block">
                    <img src="{{asset('/frontAsset/')}}/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="{{asset('/frontAsset/')}}/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{Cart::getContent()->count()}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            @foreach(Cart::getContent() as $item)
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{asset($item->attributes->ItemImage)}}" height="80px" width="80px" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            {{$item->name}}
                                        </a>

                                        <span class="header-cart-item-info">
											{{$item->quantity}} x ${{$item->price}}
										</span>
                                    </div>
                                </li>
                            @endforeach


                        </ul>

                        <div class="header-cart-total">
                            Total: $75.00
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{url('/cart-content')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{url('/cart-content')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">
                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
                </li>

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
							<span class="topbar-email">
					            @if(isset(Auth::user()->id))
                                    {{Auth::user()->name}}
                                @endif
					        </span>
                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a class="{!! Request::is('/') ? 'sale-noti':'' !!}" href="{{url('/')}}">Home</a>

                    <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                </li>

                <li>
                    <a href="{{url('/my-order')}}">My Order</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="{{url('/order-tracking')}}">Tracking</a>
                </li>
                @if(isset(Auth::user()->id) && Auth::user()->role=="admin")
                    <li>
                        <a href="{{url('/admin-view')}}">Admin</a>
                    </li>
                @endif
                <li>
                    <a href="{{url('/order-tracking')}}">Tracking</a>
                </li>
                @if(!isset(Auth::user()->id))
                    <li>
                        <a href="{{url('/login')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{url('/register')}}">Register</a>
                    </li>
                @else
                    <li class="item-menu-mobile">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
