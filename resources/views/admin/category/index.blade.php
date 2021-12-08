@extends('admin.layout.main')
@section('title')
    Danh mục sản phẩm
@endsection
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh mục</h1>
        <div class="list-btn">
            <a class="btn btn-primary btn__add__href" href="{{ route('category.add') }}"><i class="fas fa-plus"></i> &nbsp;Thêm mới</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:40%;">Tên</th>
                        <th style="width:25%">Ngày tạo</th>
                        <th class="d-none d-md-table-cell" style="width:25%">Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($cats->count() > 0)
                        @foreach($cats as $cat)
                            <tr>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->created_at }}</td>
                                <td class="d-none d-md-table-cell">
                                    @if($cat->status == 1)
                                        <a class="btn btn-success" href="{{ route('category.update.status', $cat->id) }}">Hoạt động</a>
                                    @else
                                        <a class="btn btn-danger" href="{{ route('category.update.status', $cat->id) }}">Ngừng hoạt động</a>
                                    @endif
                                </td>
                                <td class="table-action" style="display: flex;">
                                    <a class="btn btn-primary btn__add__href" href="{{ route('category.edit', $cat->id) }}">Sửa</a> &nbsp;
                                    @if(Auth::user()->level == 1)
                                    <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                        data-href="{{ route('category.delete', $cat->id) }}">Xóa
                                    </button>
                                    @endif
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
                <div class="float-right" style="    display: flex;
    justify-content: end;
    padding-top: 15px;">
                    {{ $cats->links() }}
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
