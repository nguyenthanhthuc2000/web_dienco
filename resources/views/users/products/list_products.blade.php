@extends('users.layout.main')
@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
<div class="shop_sidebar_area">

    <!-- ##### Single Widget ##### -->
    <div class="widget catagory mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-30">Chuyên mục</h6>

        <!--  Catagories  -->
        <div class="catagories-menu">
            <ul>
                @foreach ($listCategories as $catagory)
                    <li class=""><a href="{{ route( 'users.product.category',$catagory->slug) }}">{{ $catagory->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-flex justify-content-end">
                    <img src="{{ asset('/for_users/img/core-img/filter.png') }}" width="30" height="30" class="filter"> Bộ lọc
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Single Product Area -->
            @foreach ($listProducts as $product)
                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="{{ route('users.product.detail', $product->slug) }}"><img src="{{ asset('upload/products/'.$product->image) }}" alt=""></a>
                        </div>

                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">
                                    @if($product->price == 0)
                                        Giá: liên hệ
                                    @else
                                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                                    @endif
                                </p>
                                <a href="{{ route('users.product.detail', $product->slug) }}">
                                    <h6>{{ $product->name }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($listProducts->count() == 0)
                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                    <div class="single-product-wrapper">
                        Không có dữ liệu
                    </div>
                </div>
                @endif
        </div>

        <div class="row">
            <div class="col-12">
                {{ $listProducts->links() }}
            </div>
        </div>
    </div>
    <div class="filter-bar">
        <div class="filter-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <form action="{{ url()->current() }}" method="get">
            <div class="product-sorting">
                @csrf
                <div class="sort-by-date p-0">
                    <p class="p-0">Chọn khoản giá </p>
                    <div class="mb-2">
                        <input type="number" class="form-control" id="voucher" min="0" placeholder="Từ"
                        value="{{ (request()->get('from') != '') ? request()->get('from') : '' }}" name="from" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" class="form-control" id="voucher" min="0" placeholder="Đến"
                        value="{{ (request()->get('to') != '') ? request()->get('to') : '' }}" name="to" required>
                    </div>
                </div>
                <div class="sort-by-date p-0 mb-2">
                    <p class="mb-0 mt-2">Sắp xếp theo giá </p>
                    <select name="sort" id="sortBydate" class="w-100">
                        <option value="up" {{ (request()->get('sort') == 'up') ? 'selected' : '' }}>Tăng dần</option>
                        <option value="down" {{ (request()->get('sort') == 'down') ? 'selected' : '' }}>Giảm dần</option>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success mt-3">Lọc</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('active')
    <script>
        {{--active menu--}}
        $(".catagories-menu li a").filter(function(){
            return this.href == location.href;
        }).parents("li").addClass("active");
    </script>
@endpush
@endsection
