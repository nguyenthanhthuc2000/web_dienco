@extends('admin.layout.main')
@section('title')
    Thay đổi mật khẩu
@endsection
@section('content')
    @include('admin.layout.alert')
    <h1 class="h3 mb-3">Đổi mật khẩu</h1>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.post.change.password') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Mật khẩu cũ</label>
                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu cũ">
                            @error('password')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="newpassword" placeholder="Nhập mật khẩu mới">
                            @error('newpassword')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mật khẩu (xác nhận)</label>
                            <input type="password" class="form-control" name="confirmpassword" placeholder="Nhập mật khẩu xác nhận">
                            @error('confirmpassword')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

