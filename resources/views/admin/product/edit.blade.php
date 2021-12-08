@extends('admin.layout.main')
@section('title')
    Chỉnh sửa sản phẩm
@endsection
@section('content')
    <form  method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="header-page">
            <h1 class="h3 mb-3">Chỉnh sửa sản phẩm</h1>
            <div class="list-btn">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Tên sản phẩm <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name" value="{{$product->name}}"
                                   onkeyup="ChangeToSlug();" id="slug">
                            @if(Session::has('nameExist'))
                                <span class="error text-danger">{{ Session::get('nameExist') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Slug <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" placeholder="Đường dẩn sản phẩm" name="slug" readonly
                                   id="convert_slug" value="{{$product->slug}}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Số lượng</label>
                                <input type="number" class="form-control" value="{{$product->remains}}" id="inputEmail4" value="0" name="remains" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Đã bán</label>
                                <input type="number" class="form-control" value="{{$product->quantity}}" id="inputPassword4" value="0" name="quantity" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Giá bán</label>
                                <input type="number" class="form-control" value="{{$product->price}}" id="inputPassword4" value="0" name="price" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" placeholder="Nhập mô tả" rows="8" name="description">{{$product->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputState">Danh mục sản phẩm <span style="color: red;">*</span></label>
                            <select id="inputState" class="form-control" name="category">
                                <option value="" disabled>Chọn danh mục</option>
                                @foreach($categorys as $category)
                                    <option  value="{{ $category->id }}" {{$category->id == $product->category ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label w-100">Hình ảnh</label>
                            <input type="file"  id="input_file_img" name="image" onchange="review_img(event)">
                            {{--                        <small class="form-text text-muted">Example block-level help text here.</small>--}}
                        </div>
                        <div class="review-img">
                            @if($product->image != null)
                                <img id="review-img" src="{{asset('/upload/products/'.$product->image)}}">
                            @else
                                <img id="review-img" src="{{asset('/images/noimage.png')}}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script>

    </script>
@endpush
