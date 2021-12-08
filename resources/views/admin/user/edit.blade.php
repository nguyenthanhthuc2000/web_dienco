@extends('admin.layout.main')
@section('title')
    Tạo tài khoản
@endsection
@section('content')
    @include('admin.layout.alert')
    <h1 class="h3 mb-3">Tạo tài khoản</h1>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Tên tài khoản</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên tài khoản" value="{{$user->name}}">
                            @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Địa chỉ email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ email" value="{{$user->email}}">
                            @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                            @if(Session::has('emailExist'))
                                <span class="error text-danger">{{ Session::get('emailExist') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                                @if($user->status == 1)
                                    <option value="1" selected>Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                @else
                                    <option value="0" selected>Không hoạt động</option>
                                    <option value="1">Hoạt động</option>
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

