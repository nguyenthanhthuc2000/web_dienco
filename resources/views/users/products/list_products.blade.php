@extends('users.layout.main')
@section('content')
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach ($listProducts as $product)
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="shop.html">
                        <img src="{{ '/upload/products/'.$product->image }}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>Giá {{ $product->price }}</p>
                            <h4>{{ $product->name }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection