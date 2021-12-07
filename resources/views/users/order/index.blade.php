@extends('users.layout.main')
@section('content')

    <div class="cart-table-area section-padding-100 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="cart-title mt-50">
                        <h2>Giỏ hàng</h2>
                    </div>

                    <div class="cart-table clearfix">
                        <table class="table table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $total = 0;
                            ?>
                            @if(Session::has('carts'))
                                    @foreach(Session::get('carts') as $key => $pro)
                                        <tr>
                                            <td class="cart_product_img">
                                                <a href="#"><img src="{{ asset('upload/products/'.$pro['product_image']) }}" alt="Product"></a>
                                            </td>
                                            <td class="cart_product_desc">
                                                <h5>{{ $pro['product_name'] }}</h5>
                                                <p>{{ number_format($pro['product_price'],0,',','.') }}</p>
                                            </td>
                                            <td class="qty">
                                                <div class="qty-btn d-flex">
                                                    <p>SL</p>
                                                    <div class="quantity">
                                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty > 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="{{ $pro['product_qty'] }}">
                                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td >
                                                <?php
                                                $subtotal = $pro['product_price']*$pro['product_qty'];
                                                $total += $subtotal;
                                                ?>
                                                <span>{{ number_format($subtotal,0,',','.') }}</span>
                                            </td>
                                            <td>Xóa</td>
                                        </tr>
                                    @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <strong> Không có dữ liệu</strong>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Tổng giỏ hàng</h5>
                        <ul class="summary-table">
                            <?php
                                if($total > 0){
                                    Session::put('total', $total);
                                }
                            ?>
                            <li><span>Đơn giá:</span> <span>{{ number_format($total,0,',','.') }}</span></li>
                            <li><span>Phí vận chuyển:</span> <span>Free</span></li>
                            <li><span>Tổng thanh toán:</span> <span>{{ number_format($total,0,',','.') }}</span></li>
                        </ul>
                        <div class="cart-btn mt-100">
                            <a href="{{ route('users.checkout') }}" class="btn amado-btn w-100">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
