@extends('users.layout.main')
@section('content')
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach ($listCategory as $category)
                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="{{ route('users.product.category', $category->slug) }}">
                        <img src="{{ '/upload/products/'.$category->image }}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>Giá từ @foreach ($minPrice as $price)
                                        @if($category->id == $price['idCategory'])
                                            {{ number_format($price['minPrice'], 0, ',', '.') }}
                                        @endif
                                    @endforeach VNĐ
                            </p>
                            <h4>{{ $category->name }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection