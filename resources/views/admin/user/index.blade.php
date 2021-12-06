@extends('admin.layout.main')
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh sách nhân viên</h1>
        <div class="list-btn">
            <a class="btn btn-primary btn__add__href" href="{{ route('user.add') }}"><i class="fas fa-plus"></i> &nbsp;Thêm mới</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th>Hoạt động</th>
                        <th>Trạng thái</th>
                        <th class="text-right">Thao tác</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if($users->count() > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a class="btn btn-dark" href="{{ route('history.detail', $user->id) }}">Xem chi tiết</a>
                                    </td>
                                    <td>
                                        @if($user->status == 1)
                                            <a class="btn btn-success" href="{{ route('user.update.status', $user->id) }}">Hoạt động</a>
                                        @else
                                            <a class="btn btn-danger" href="{{ route('user.update.status', $user->id) }}">Không hoạt động</a>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-info btn__add__href" href="{{ route('user.reset.password', $user->id) }}">Đặt lại mật khẩu</a>
                                        <a class="btn btn-primary btn__add__href" href="{{ route('user.edit', $user->id) }}">Sửa</a>
                                        <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                                data-href="{{ route('user.delete', $user->id) }}">Xóa
                                        </button>
                                    </td>
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
