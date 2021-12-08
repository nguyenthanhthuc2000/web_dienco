@extends('admin.layout.main')
@section('title')
    Lịch sử hoạt động của {{$user->name}}
@endsection
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Lịch sử hoạt động của {{$user->name}}</h1>
        <div class="list-btn">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Nội dung</th>
                        <th>Ngày tạo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($historys->count() > 0)
                        @foreach($historys as $history)
                            <tr>
                                <td>
                                    {{$history->action}}
                                </td>
                                <td>{{$history->created_at}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
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
