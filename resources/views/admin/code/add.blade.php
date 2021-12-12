@extends('admin.layout.main')
@section('title')
Thêm mới mã giảm giá
@endsection
@section('content')
    <div class="header-page">
        <h1 class="h3 mb-3">Thêm mới mã giảm giá</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('code.store') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Tên <span style="color:red;">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên"
                                       value="{{ old('name') }}"
                                >
                                @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Code <span style="color:red;">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Nhập code"
                                value="{{ old('code') }}"
                                >
                                @error('code')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Số lượng </label>
                                <input type="number" name="total" class="form-control" placeholder="Nhập số lượng"
                                       onkeypress="return isNumberKey(event)" value="{{ old('total') ? old('total') : 0}}"
                                >
                                @error('total')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Đã dùng </label>
                                <input type="number" name="used" class="form-control" placeholder="Nhập số lượng đã dùng"
                                       onkeypress="return isNumberKey(event)" value="{{ old('used') ? old('used') : 0}}"
                                >
                                @error('used')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Số giảm</label>
                                <input type="number" name="number" class="form-control" placeholder="Nhập số"
                                       onkeypress="return isNumberKey(event)" value="{{ old('number') ? old('number') : 0 }}"
                                >
                                @error('number')
                                <span class="error text-danger" >{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Ngày bắt đầu <span style="color:red;">*</span></label>
                                <input type="date" name="date_start" class="form-control" value="{{ old('date_start') }}"

                                >
                                @error('date_start')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Ngày kết thúc <span style="color:red;">*</span></label>
                                <input type="date" name="date_end" class="form-control" value="{{ old('date_end') }}"

                                >
                                @error('date_end')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState">Hình thức giảm <span style="color:red;">*</span></label>
                                <select id="inputState" class="form-control" name="type">
                                    <option value="2">Giảm theo tiền</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Trạng thái</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                                @error('status')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

