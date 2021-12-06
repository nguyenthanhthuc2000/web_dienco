@extends('users.layout.main')
@section('content')
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach ($listCategory as $category)
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="shop.html">
                        {{-- <img src="{{ '/upload/products/'.$product->image }}" alt=""> --}}
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            {{-- <p>Giá </p> --}}
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection