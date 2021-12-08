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

    <!-- ##### Single Widget ##### -->
    {{-- <div class="widget price mb-50">
        <!-- Widget Title -->
        <h6 class="widget-title mb-2">Chọn khoản giá</h6>

        <div class="widget-desc">
            <div class="slider-range">
                <div data-min="10" data-max="1000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1000" data-label-result="">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                </div>
                <div class="range-price">$10 - $1000</div>
                <form action="{{ url()->current() }}" method="get">
                    <div class="col-12 p-0 mb-2">
                        <input type="number" class="form-control" id="voucher" min="0" placeholder="Từ" value="" name="from" required>
                    </div>
                    <div class="col-12 p-0">
                        <input type="number" class="form-control" id="voucher" min="0" placeholder="Đến" value="" name="to" required>
                    </div>
                    <div class="col-12 p-0 text-right">
                        <button type="submit" class="btn btn-success mt-3">Lọc</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
</div>
<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-xl-flex align-items-end justify-content-end">
                    <!-- Total Products -->
                    {{-- <div class="total-products">
                        <p>Hiển thị 1-6 trên 25 sản phẩm</p>
                    </div> --}}
                    <!-- Sorting -->
                    <form action="{{ url()->current() }}" method="get">
                        <div class="product-sorting d-flex justify-content-end">
                                @csrf
                            <div class="sort-by-date d-flex align-items-center justify-content-end">
                                <p class="col-3 p-0 text-center">Chọn khoản giá </p>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="voucher" min="0" placeholder="Từ" 
                                    value="{{ (request()->get('from') != '') ? request()->get('from') : '' }}" name="from" required>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control" id="voucher" min="0" placeholder="Đến"
                                    value="{{ (request()->get('to') != '') ? request()->get('to') : '' }}" name="to" required>
                                </div>
                            </div>
                            <div class="sort-by-date d-flex align-items-center mr-15">
                                <p>Sắp xếp theo giá </p>
                                <select name="sort" id="sortBydate">
                                    <option value="up" {{ (request()->get('sort') == 'up') ? 'selected' : '' }}>Tăng dần</option>
                                    <option value="down" {{ (request()->get('sort') == 'down') ? 'selected' : '' }}>Giảm dần</option>
                                </select>
                                <button type="submit" class="btn btn-success ml-3">Lọc</button>
                            </div>
                        </div>
                    </form>
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
                            <img src="{{ asset('upload/products/'.$product->image) }}" alt="">
                            <!-- Hover Thumb -->
                            {{-- <img class="hover-img" src="img/product-img/product2.jpg" alt=""> --}}
                        </div>

                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                                <a href="{{ route('users.product.detail', $product->slug) }}">
                                    <h6>{{ $product->name }}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Pagination -->
                {{-- <nav aria-label="navigation">
                    <ul class="pagination justify-content-end mt-50">
                        <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                        <li class="page-item"><a class="page-link" href="#">02.</a></li>
                        <li class="page-item"><a class="page-link" href="#">03.</a></li>
                        <li class="page-item"><a class="page-link" href="#">04.</a></li>
                    </ul>
                </nav> --}}
                {{ $listProducts->links() }}
            </div>
        </div>
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