@extends('admin.layout.main')
@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh sách sản phẩm</h1>
        <div class="list-btn">
            <a class="btn btn-primary btn__add__href" href="{{ route('product.add') }}"><i class="fas fa-plus"></i> &nbsp;Thêm mới</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 pt-2">
            <form method="get" action="{{ route('product.index') }}">
                @csrf
                <div class="input-group input-group-navbar">
                    <input type="text" class="form-control" name="id" placeholder="Nhập ID sản phẩm" aria-label="Search" style="    background: #ffffff;">
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
{{--        <div class="col-md-6 pt-2">--}}
{{--            <form class="">--}}
{{--                <div class="input-group input-group-navbar">--}}
{{--                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" aria-label="Search" style="    background: #ffffff;">--}}
{{--                    <div class="input-group-append">--}}
{{--                        <button class="btn" style="    background: #fff;">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                 class="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
    </div>
    <br>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th class="text-center">Giá(VNĐ)</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Đã bán</th>
                    <th>Trạng thái</th>
                    <th class="text-right">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                {{-- rounded-circle  class_radio50%--}}
                                @if($product->image != null)
                                <img src="{{asset('/upload/products/'.$product->image)}}" width="48" height="48" class=" mr-2 img" alt="img"> {{$product->name}}
                                @else
                                <img src="{{asset('/images/noimage.png')}}" width="48" height="48" class=" mr-2" alt="img"> {{$product->name}}
                                @endif
                            </td>
                            <td class="text-center">{{ number_format($product->price,0,',','.')}}</td>
                            <td class="text-center">{{ number_format($product->remains,0,',','.')}}</td>
                            <td class="text-center">{{ number_format($product->quantity,0,',','.')}}</td>
                            <td>
                                @if($product->status == 1)
                                    <a class="btn btn-success" href="{{ route('product.update.status', $product->id) }}">Hoạt động</a>
                                @else
                                    <a class="btn btn-danger" href="{{ route('product.update.status', $product->id) }}">Ngừng bán</a>
                                @endif
                            </td>
                            <td class="text-right" >
                                <a class="btn btn-primary btn__add__href" href="{{ route('product.edit', $product->id) }}">Sửa</a>
                                @if(Auth::user()->level == 1)
                                <button class="btn btn-warning btn__add__href btn-delete" type="button"
                                        data-href="{{ route('product.delete', $product->id) }}">Xóa
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
                {{ $products->links() }}
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
