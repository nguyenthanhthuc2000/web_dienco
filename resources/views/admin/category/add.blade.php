@extends('admin.layout.main')
@section('content')
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="header-page">
        <h1 class="h3 mb-3">Thêm mới danh mục</h1>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
    <br>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục"
                                   onkeyup="ChangeToSlug();" id="slug"
                            >
                            @error('name')
                            <span class="error text-danger" >{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Đường dẩn</label>
                            <input type="text"  name="slug" class="form-control" placeholder="Đường dẩn" readonly
                                   id="convert_slug" >
                            @error('slug')
                            <span class="error text-danger" >{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label w-100">Hình ảnh</label>
                        <input type="file"  id="input_file_img" name="image" onchange="review_img(event)">
                        @error('image')
                        <span class="error text-danger" >{{ $message }}</span>
                        @enderror
                        {{--                        <small class="form-text text-muted">Example block-level help text here.</small>--}}
                    </div>
                    <div class="review-img">
                        <img id="review-img" src="{{asset('/images/noimage.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

