@extends('users.layout.main')
@section('title')
    {{ $detailProduct['name'] }}
@endsection
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
                            <p class="product-price">
                                @if($detailProduct['price'] == 0)
                                    Giá: liên hệ
                                @else
                                    {{ number_format($detailProduct['price'], 0, ',', '.') }} VNĐ
                                @endif
                            </p>
                            <a href="">
                                <h6>{{ $detailProduct['name'] }}</h6>
                            </a>
                            <!-- Ratings & Review -->
                            <div class="ratings-review mb-1 d-flex justify-content-between">
                                <div class="review">
                                    <button type="button" class="btn btn-mute shadow-none" data-toggle="modal" data-target="#review">Viết đánh giá</button>
                                </div>
                                <div class="comment">
                                    <button type="button" class="btn bg-secondary text-light shadow-none" data-toggle="modal" data-target="#comment">Xem đánh giá</button>
                                </div>
                            </div>
                        </div>

                        <div class="short_overview my-3">
                            <p>{{ $detailProduct['description'] }}</p>
                        </div>

                        <!-- Add to Cart Form -->
                        <form class="cart clearfix" method="post">
                            @if($detailProduct['status'] == 1)
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
                                    data-sl="{{$detailProduct['remains']}}"
                                    data-price="{{$detailProduct['price']}}"
                                    data-url="{{ route('users.add.cart') }}"
                            >Thêm vào giỏ hàng
                            </button>
                                @else
                                <button type="button" value="5" class="btn amado-btn "
                                >Sản phẩm đã ngừng kinh doanh
                                </button>
                                @endif
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
            <form action="{{ route('users.product.comment') }}" method="post">
            @csrf
                <input value="{{ $detailProduct['id'] }}" type="text" hidden name="id_product">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viết đánh giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên</label>
                        <input type="text" class="form-control" id="recipient-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nội dung:</label>
                        <textarea class="form-control" id="message-text" name="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>

            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đánh giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(count($listComments) == 0)
                    <div class="col-12 text-center">Chưa có đánh giá</div>
                @else
                    @foreach($listComments as $comment)
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="comment-text w-100 d-flex align-items-center">
                                <h6 class="font-medium mb-0">{{ $comment->name }}:</h6>
                                <p class="m-b-15 d-block ml-3 text-sm m-0">{{ $comment->contents }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </div>
        </div>
    </div>
    @endpush
    @if(Session::has('success'))
        @push('js')
            <script>
                Swal.fire({
                    title: 'Đã gửi đánh giá',
                    icon: 'success',
                    showCancelButton: false,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Hủy',
                    timer: 2000
                })
            </script>
    @endpush
    @endif
@endsection
