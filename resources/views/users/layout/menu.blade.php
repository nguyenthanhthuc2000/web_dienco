<div class="main-content-wrapper d-flex clearfix">

    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
            <a href="{{ route('users.index') }}"><img src="/for_users/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Header Area Start -->
    <header class="header-area clearfix">
        <!-- Close Icon -->
        <div class="nav-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('users.index') }}"><img src="/for_users/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Amado Nav -->
        <nav class="amado-nav">
            <ul>
                <li><a href="{{ route('users.index') }}">Trang chủ</a></li>
                <li><a href="{{ route('users.product') }}">Sản phẩm</a></li>
                {{-- <li><a href="cart.html">Cart</a></li> --}}
                <li><a href="{{ route('users.checkout') }}">Thanh toán</a></li>
            </ul>
        </nav>
        <!-- Button Group -->
        {{-- <div class="amado-btn-group mt-30 mb-100">
            <a href="#" class="btn amado-btn mb-15">%Discount%</a>
            <a href="#" class="btn amado-btn active">New this week</a>
        </div> --}}
        <!-- Cart Menu -->
        <div class="cart-fav-search mb-100">
            <a href="{{ route('users.cart') }}" class="cart-nav">
                <img src="/for_users/img/core-img/cart.png" alt=""> Giỏ hàng <span class="total-product">(
                    <?php
                        if(Session::has('carts')){
                            echo count(Session::get('carts'));
                        }
                        else {
                            echo 0;
                        }
                    ?>
                )</span>
            </a>
            {{-- <a href="#" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> Favourite</a>
            <a href="#" class="search-nav"><img src="img/core-img/search.png" alt=""> Search</a> --}}
        </div>
        <!-- Social Button -->
        {{-- <div class="social-info d-flex justify-content-between">
            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </div> --}}
    </header>
    <!-- Header Area End -->
</div>
