@extends('users.layout.main')
@section('title')
    Thanh toán
@endsection
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
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Tên đầy đủ" required>
                                        @error('name')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                                        @error('email')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control mb-3" name="address" placeholder="Địa chỉ" value="{{old('address')}}">
                                        @error('address')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="number" class="form-control" onkeypress="return isNumberKey(event)" name="phone" min="0" placeholder="Số điện thoại" value="{{old('phone')}}">
                                        @error('phone')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea class="form-control w-100" id="comment" name="note" cols="30" rows="10" placeholder="Nội dụng ghi chú"></textarea>
                                        @error('note')
                                        <span class="error text-danger" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
                                @if(Session::has('discount_code'))
                                    <?php
                                    $code = Session::get('discount_code');
                                    $reduce = 0;
                                    if($code[0]['discount_type'] == 2){
                                        $reduce = $code[0]['discount_number'];
                                    }
                                    else{
                                        $reduce = ($total / 100) * $code[0]['discount_number'];
                                    }
                                    $total = $total - $reduce;

                                    ?>
                                    <li><span>Giảm giá ( {{$code[0]['discount_code']}} )</span> <span>{{ number_format($reduce, 0, ',', '.') }}</span></li>
                                @endif
                                <li><span>Phí vận chuyển:</span> <span>Miễn phí</span></li>
                                {{-- <li>
                                    <div class="col-12 p-0">
                                        <input type="text" class="form-control" id="voucher" min="0" placeholder="Nhập mã giảm giá" value="">
                                    </div>
                                </li> --}}
                                <li><span>Tổng thanh toán:</span> <span>{{ number_format($total,0,',','.') }}</span></li>
                                <input type="text" name="total" value="{{$total}}" hidden>
                            </ul>
                            <div class="cart-btn mt-100">
                                <button class="btn amado-btn w-100">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
        </div>
@endsection
