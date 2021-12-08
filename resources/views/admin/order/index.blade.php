@extends('admin.layout.main')
@section('title')
    Hóa đơn
@endsection
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Hóa đơn</h1>
        <div class="">
            <form method="get" action="{{ route('order.index') }}">
                @csrf
                <div class="input-group input-group-navbar">
                    <input type="text" class="form-control" name="order_code" placeholder="Nhập mã hóa đơn" aria-label="Search" style="    background: #ffffff;">
                    <div class="input-group-append">
                        <button class="btn" style="    background: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày lập</th>
                        <th>Tổng(VNĐ)</th>
                        <th>Trạng thái</th>
                        <th class="text-right">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($orders->count() > 0)
                        @foreach($orders as $order)
                        <tr>
                            <td>{{strtoupper($order->order_code)}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{ number_format($order->total_money,0,',','.')}}</td>
                            <td>
                                @if($order->status == 0)
                                    Chờ xử lí
                                @elseif($order->status == 1)
                                    Đang xử lí
                                @elseif($order->status == 2)
                                    Thành công
                                @else
                                    Đã hủy
                                @endif
                            </td>
                            <td class="text-right">
                                <a class="btn btn-primary btn__add__href" href="{{ route('order.detail', $order->order_code) }}">Chi tiết</a>
                                @if(Auth::user()->level == 1)&nbsp;
                                <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                        data-href="{{ route('order.delete', $order->id) }}">Xóa
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <strong> Không có dữ liệu</strong>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="float-right" style="    display: flex;
    justify-content: end;
    padding-top: 15px;">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.btn-delete').click(function(){
            var url = $(this).data('href');
            Swal.fire({
              title: 'Bạn có chắc chắn xóa?',
              text: "Sau khi xóa không thể khôi phục!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Xóa ngay',
              cancelButtonText: 'Hủy'
            }).then((result) => {
              if (result.isConfirmed) {
                   window.location.href = url;
              }
            })
        })
    </script>
@endpush

