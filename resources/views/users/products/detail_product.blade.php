@extends('users.layout.main')
@section('content')

    <!-- Product Details Area Start -->
    <div class="single-product-area section-padding-100 clearfix">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="single_product_thumb">
                        <img src="{{ asset('upload/products/'.$detailProduct['image']) }}" alt="{{ $detailProduct['name'] }}">
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="single_product_desc">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">{{ number_format($detailProduct['price'],0,'.',' ') }} VNĐ</p>
                            <a href="">
                                <h6>{{ $detailProduct['name'] }}</h6>
                            </a>
                            <!-- Ratings & Review -->
                            <div class="ratings-review mb-15">
                                <div class="review">
                                    <button type="button" class="btn bg-transparent pl-0 pr-0 shadow-none" data-toggle="modal" data-target="#review">Viết đánh giá</button>
                                </div>
                            </div>
                        </div>

                        <div class="short_overview my-5">
                            <p>{{ $detailProduct['description'] }}</p>
                        </div>

                        <!-- Add to Cart Form -->
                        <form class="cart clearfix" method="post">
                            <div class="cart-btn d-flex mb-50">
                                <p>Số lượng</p>
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                    <input type="number" class="qty-text cart_product_qty_{{$detailProduct['id']}}" id="qty" step="1" min="1" max="300" name="quantity" value="1"

                                    >
                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <button type="button" value="5" class="btn amado-btn add-cart"
                                    data-id="{{$detailProduct['id']}}"
                                    data-sl="{{$detailProduct['quantity']}}"
                                    data-price="{{$detailProduct['price']}}"
                                    data-url="{{ route('users.add.cart') }}"
                            >Thêm vào giỏ hàng
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Area End -->
    @push('modal')
     <!-- Modal -->
     <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đánh giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Tên</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Nội dung:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Gửi</button>
            </div>
            </div>
        </div>
    </div>
    @endpush
@endsection
