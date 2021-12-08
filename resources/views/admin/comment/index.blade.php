@extends('admin.layout.main')
@section('title')
    Danh sách bình luận
@endsection
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh sách bình luận</h1>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên</th>
                        <th>Bình luận</th>
                        <th>Ngày bình luận</th>
                        <th class="text-right">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($comments->count() > 0)
                        @foreach($comments as $comment)
                        <tr>
                            @foreach($products as $product)
                                @if($product->id == $comment->id_product)
                                    <td><a href="{{ route('users.product.detail', $product->slug) }}">{{$product->name}}</a></td>
                                @endif
                            @endforeach
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->contents}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td class="text-right">
                                {{-- <a class="btn btn-primary btn__add__href" href="{{ route('order.detail', $comment->order_code) }}">Chi tiết</a> --}}
                                @if(Auth::user()->level == 1)&nbsp;
                                <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                        data-href="{{ route('product.comment.delete', $comment->id) }}">Xóa
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
                <div class="float-right" style="display: flex;justify-content: end;padding-top: 15px;">
                    {{ $comments->links() }}
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

