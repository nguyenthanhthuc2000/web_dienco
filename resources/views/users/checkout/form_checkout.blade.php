@extends('users.layout.main')
@section('content')

<div class="cart-table-area section-padding-100">
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
                            <h5>Tổng đơn hàng</h5>
                            <ul class="summary-table">
                                <li><span>Phụ thu:</span> <span>$140.00</span></li>
                                <li><span>Phí vận chuyển:</span> <span>Free</span></li>
                                <li><span>Tổng cộng:</span> <span>$140.00</span></li>
                            </ul>

                            <div class="cart-btn mt-100">
                                <a href="#" class="btn amado-btn w-100">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection