@extends('admin.layout.main')
@section('content')
    <div class="header-page">
        <h1 class="h3 mb-3">Chỉnh sửa danh mục</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.update', $cat->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục"
                                   onkeyup="ChangeToSlug();" id="slug"
                                   value="{{ $cat->name }}"
                            >
                            @error('name')
                            <span class="error text-white" style="    font-size: small;font-size: small;    background: #33333333;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Đường dẩn</label>
                            <input type="text"  name="slug" class="form-control" placeholder="Đường dẩn" readonly
                                   id="convert_slug" value="{{ $cat->slug }}"
                            >
                            @error('slug')
                            <span class="error text-white" style="    font-size: small;font-size: small;    background: #33333333;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                                @if($cat->status == 0)
                                    <option value="0">Không hoạt động</option>
                                    <option value="1">Hoạt động</option>
                                @else
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                @endif

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

