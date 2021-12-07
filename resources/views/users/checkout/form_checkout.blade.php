@extends('users.layout.main')
@section('content')
<div class="cart-table-area section-padding-100">
    <form action="{{ route('users.store.order') }}" method="post">
        @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Thanh toán</h2>
                            </div>
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="text" class="form-control" id="name" value="" placeholder="Tên đầy đủ" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="Email" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" id="address" placeholder="Địa chỉ" value="">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="number" class="form-control" id="phone_number" min="0" placeholder="Số điện thoại" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Nội dụng ghi chú"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <?php
                            $total = 0;
                                if(Session::has('carts')){

                                    foreach(Session::get('carts') as $key => $pro){
                                        $subtotal = $pro['product_price']*$pro['product_qty'];
                                        $total += $subtotal;
                                    }
                                }
                            ?>
                            <h5>Tổng giỏ hàng</h5>
                            <ul class="summary-table">
                                <li><span>Đơn giá:</span> <span>{{ number_format($total,0,',','.') }}</span></li>
                                <li><span>Phí vận chuyển:</span> <span>Free</span></li>
                                {{-- <li>
                                    <div class="col-12 p-0">
                                        <input type="text" class="form-control" id="voucher" min="0" placeholder="Nhập mã giảm giá" value="">
                                    </div>
                                </li> --}}
                                <li><span>Tổng thanh toán:</span> <span>{{ number_format($total,0,',','.') }}</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="{{ route('users.checkout') }}" class="btn amado-btn w-100">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
        </div>
@endsection
