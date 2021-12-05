@extends('admin.layout.main')
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh sách mã giảm giá</h1>
        <div class="list-btn">
            <a class="btn btn-primary btn__add__href" href="{{ route('code.add') }}"><i class="fas fa-plus"></i> &nbsp;Thêm mới</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Code</th>
                            <th>Số lượng</th>
                            <th>Đã dùng</th>
                            <th>Hình thức giảm</th>
                            <th>Giảm</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if($codes->count() > 0)
                        @foreach($codes as $code)
                            <tr>
                                <td>{{$code->name}}</td>
                                <td>{{$code->code}}</td>
                                <td>{{$code->total}}</td>
                                <td>{{$code->used}}</td>
                                <td>
                                    @if($code->type == 1)
                                        Phần trăm
                                    @else
                                        Số tiền
                                    @endif
                                </td>
                                <td>{{$code->number}}</td>
                                <td>{{$code->date_end}}</td>
                                <td>{{$code->date_start}}</td>
                                <td>
                                    @if($code->status == 1)
                                        <a class="btn btn-success" href="{{ route('code.update.status', $code->id) }}">Hoạt động</a>
                                    @else
                                        <a class="btn btn-danger" href="{{ route('code.update.status', $code->id) }}">Ngừng</a>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-primary btn__add__href" href="{{ route('code.edit', $code->id) }}">Sửa</a> &nbsp;
                                    <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                            data-href="{{ route('code.delete', $code->id) }}">Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4">
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
