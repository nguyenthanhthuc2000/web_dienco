@extends('admin.layout.main')
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh mục sản phẩm</h1>
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
                        <th style="width:40%;">Name</th>
                        <th style="width:25%">Ngày tạo</th>
                        <th class="d-none d-md-table-cell" style="width:25%">Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cats as $cat)
                        <tr>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->created_at }}</td>
                            <td class="d-none d-md-table-cell">
                                @if($cat->status == 1)
                                    <a class="btn btn-success" href="">Hoạt động</a>
                                @else
                                    <a class="btn btn-danger" href="">Ngừng hoạt động</a>
                                @endif
                            </td>
                            <td class="table-action" style="display: flex;">
                                <a class="btn btn-primary btn__add__href" href="">Sửa</a> &nbsp;
                                <button class="btn btn-warning btn__add__href" type="button" data-href="">Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

