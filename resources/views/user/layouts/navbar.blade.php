<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-2">
                <div class="header__logo">
                    <a href="/"><img src="{{ asset('assets/user/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->is('/') ? ' active' : ''}}"><a href="/">Home</a></li>
                        <li class="{{ request()->is('shop*') ? ' active' : ''}}"><a href="/shop">Shop</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        @if(!Auth::guard('user')->check())
                            <a href="{{ route('login') }}">Login</a>
                        @else
                            <a href="#">{{Auth::guard('user')->user()->name}}</a>
                            <a href="{{ route('user.logout') }}">Logout</a>
                        @endif
                    </div>
                    <ul class="header__right__widget">
                        <li>
                            <a href="#">
                                <span class="icon_info_alt"></span>
                                <div class="tip">2</div>
                            </a>
                        </li>
                        <li>
                            <a href="shop/chart">
                                <span class="icon_cart_alt"></span>
                                <div class="tip">2</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    @yield('route')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->