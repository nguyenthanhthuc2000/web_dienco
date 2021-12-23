@extends('admin.layout.main')
@section('title')
    Chi tiết hóa đơn
@endsection
@section('content')
    <div class="header-page">
    <h1 class="h3 mb-3">Chi tiết hóa đơn {{strtoupper($order->order_code)}} - {{$order->name}} - {{$order->phone}} </h1>
    <p>Ngày lập: {{$order->created_at}} </p>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th >ID</th>
                        <th >Hình ảnh</th>
                        <th >Giá(VNĐ)</th>
                        <th>Số lượng</th>
                        <th class="text-right">Thành tiền(VNĐ)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total = 0;
                    ?>
                        @foreach($products as $pro)
                            <tr>
                                <td>{{$pro->product->id}}</td>
                                <td>
                                    @if($pro->product->image != null)
                                        <img src="{{asset('/upload/products/'.$pro->product->image)}}" width="48" height="48" class=" mr-2 img" alt="img"> {{$pro->product->name}}
                                    @else
                                        <img src="{{asset('/images/noimage.png')}}" width="48" height="48" class=" mr-2" alt="img"> {{$pro->product->name}}
                                    @endif
                                </td>
                                <td>
                                    {{ number_format( $pro->product->price,0,',','.')}}

                                </td>
                                <td>{{ $pro->quantily }}</td>
                                <td class="text-right">
                                    <?php
                                    $subtotal = $pro->quantily * $pro->product->price;
                                    $total += $subtotal;
                                    ?>
                                    {{ number_format( $subtotal,0,',','.')}}
                                </td>
                            </tr>
                        @endforeach

                        @if($pro->discount_code_id == null)
                            <tr>
                                <td colspan="5" class="text-right">
                                     <p>Tổng thanh toán:  {{ number_format( $total,0,',','.')}} vnđ</p>
                                </td>
                            </tr>
                        @else
                            <tr>

                                <?php
                                    $code = $pro->discount_code;
                                    if($code->type == 2){
                                        $reduce = $code->number;
                                    }
                                    else{
                                        $reduce = ($total / 100) *  $code->number;
                                    }
                                    $total = $total - $reduce;
                                ?>
                                <td colspan="5" class="text-right">
                                    <p>Tổng tiền:  {{ number_format( $total,0,',','.')}} vnđ</p>
                                </td>
                            </tr>
                    <tr>

                        <td colspan="5"  class="text-right">
                            <p>Giảm giá ({{$code->code}}):  {{ number_format( $reduce,0,',','.')}} vnđ</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <p>Tổng thanh toán:  {{ number_format( $total,0,',','.')}} vnđ</p>
                        </td>
                    </tr>
                    @endif
                        <tr>
                            <td colspan="3">
                                <p>Địa chỉ nhận hàng:  {{$order->address}}</p>
                            </td>
                            <td colspan="2">
                                <p>Ghi chú:  {{$order->note}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <form>
                                    <div class="form-group">
                                        <label for="inputState">Trạng thái <span style="color: red;">*</span></label>
                                        <select id="{{$order->id}}" class="form-control order_status" name="status"
                                            data-url="{{ route('order.update.status') }}"
                                        >
                                                @if($order->status == 0)
                                                    <option value="0" selected="">Chờ xử lí</option>
                                                    <option value="1">Đang xử lí</option>
                                                    <option value="2">Thành công</option>
                                                    <option value="3">Đã hủy</option>
                                                @elseif($order->status == 1)
                                                    <option value="1" selected="">Đang xử lí</option>
                                                    <option value="0" >Chờ xử lí</option>
                                                    <option value="2">Thành công</option>
                                                    <option value="3">Đã hủy</option>
                                                @elseif($order->status == 2)
                                                    <option value="2" selected="">Thành công</option>
                                                    <option value="1" >Đang xử lí</option>
                                                    <option value="0" >Chờ xử lí</option>
                                                    <option value="3">Đã hủy</option>
                                                @else
                                                    <option value="3" selected="">Đã hủy</option>
                                                    <option value="2" >Thành công</option>
                                                    <option value="1" >Đang xử lí</option>
                                                    <option value="0" >Chờ xử lí</option>
                                                @endif
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td colspan="2">
                                <form>
                                    <div class="form-group">
                                        <label for="inputState">Thanh toán <span style="color: red;">*</span></label>
                                        <select id="{{$order->id}}" class="form-control payment_status" name="payment_status"
                                                data-url="{{ route('order.update.status.payment') }}"
                                        >
                                            @if($order->payment_status == 0)
                                                <option value="0" selected="">Chưa thanh toán</option>
                                                <option value="1">Đã thanh toán</option>
                                            @elseif($order->payment_status == 1)
                                                <option value="0" >Chưa thanh toán</option>
                                                <option value="1" selected="">Đã thanh toán</option>
                                            @endif
                                        </select>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
		$('.order_status').change(function(){
			const status = $(this).val();
			const id = $(this).attr("id");
			const url = $(this).data('url');
            const txt_status = $( ".order_status option:selected" ).text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			$.ajax({
				url: url,
				method:'POST',
				data:{status:status,id:id, txt_status:txt_status},
				success:function(data){
					if(data == 1){
						Swal.fire(
                          'Cập nhật',
                          'Thành công',
                          'success'
                        )
					}
					else{
					    Swal.fire(
                          'Thất bại!',
                          'Thử lại sau!',
                          'error'
                        )
					}
				}
			})
		})

		$('.payment_status').change(function(){
			const status = $(this).val();
			const id = $(this).attr("id");
			const url = $(this).data('url');
            const txt_status = $( ".payment_status option:selected" ).text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			$.ajax({
				url: url,
				method:'POST',
				data:{status:status, id:id, txt_status:txt_status},
				success:function(data){
					if(data == 1){
						Swal.fire(
                          'Cập nhật',
                          'Thành công',
                          'success'
                        )
					}
					else{
					    Swal.fire(
                          'Thất bại!',
                          'Thử lại sau!',
                          'error'
                        )
					}
				}
			})
		})
	</script>
@endpush
