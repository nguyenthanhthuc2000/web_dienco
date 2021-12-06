@extends('admin.layout.main')
@section('content')
    <h1 class="h3 mb-3">Hóa đơn</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tổng hóa đơn</th>
                        <th>Trạng thái</th>
                        <th class="text-right">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($orders->count() > 0)
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->total_money}}</td>
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
                                <a class="btn btn-primary btn__add__href" href="{{ route('order.detail', $order->id) }}">Chi tiết</a> &nbsp;
                                <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                        data-href="{{ route('order.delete', $order->id) }}">Xóa
                                </button>
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
            </div>
        </div>
    </div>
@endsection

