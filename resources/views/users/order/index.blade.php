@extends('users.layout.main')
@section('title')
    Giỏ hàng
@endsection
@section('content')

    <div class="cart-table-area section-padding-100 ">
        <form action="{{ route('users.update.order') }}" method="post">
            @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="cart-title mt-50">
                        <h2>Giỏ hàng</h2>
                    </div>

                    @include('admin.layout.alert')

                    <div class="cart-table clearfix">
                        <table class="table table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $total = 0;
                            ?>
                            @if(Session::has('carts') && count(Session::get('carts')) > 0)
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
                                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty{{$pro['product_id']}}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty > 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                        <input type="number" class="qty-text" id="qty{{$pro['product_id']}}" step="1" min="1" max="300" name="qty[{{$pro['product_id']}}]" value="{{ $pro['product_qty'] }}">
                                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty{{$pro['product_id']}}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
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
                                            <td>
                                                <button type="button" data-url="{{ route('users.del.cart', $pro['product_id']) }}" class="btn btn-danger btn-delete">Xóa</button>
                                            </td>
                                        </tr>
                                    @endforeach
                            @else
                                <tr class="d-block">
                                    <td colspan="5" class="text-center text-dark">
                                        <strong>Không có dữ liệu  <a href="{{ route('users.product') }}" class="text-primary"><i>(Quay lại mua sắm)</i></a></strong>
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
                                    Session::put('reduce', $reduce);

                                ?>
                                <li><span>Giảm giá ( {{$code[0]['discount_code']}} )</span> <span>{{ number_format($reduce, 0, ',', '.') }}</span></li>
                            @endif
                            <li><span>Phí vận chuyển:</span> <span>Miễn phí</span></li>
                            <li>
                                <div class="col-12 p-0">
                                    <input type="text" class="form-control" name="discount_code"  min="0" placeholder="Nhập mã giảm giá" value="">
                                </div>
                            </li>
                            <li><span>Tổng thanh toán:</span> <span>{{ number_format($total,0,',','.') }}</span></li>
                        </ul>
                        <div class="cart-btn">
                            <button class="btn amado-btn w-100">Cập nhật giỏ hàng</button>
                        </div>
                        <div class="cart-btn mt-30">
                            <a href="{{ route('users.checkout') }}" class="btn amado-btn w-100">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $('.btn-delete').click(function(){
            var url = $(this).data('url');
            Swal.fire({
              title: 'Bạn có chắc chắn xóa?',
              text: "Sản phẩm giá rẽ mà mua đi mà :(( ",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Xóa',
              cancelButtonText: 'Hủy'
            }).then((result) => {
              if (result.isConfirmed) {
                   window.location.href = url;
              }
            })
        })
    </script>
@endpush
