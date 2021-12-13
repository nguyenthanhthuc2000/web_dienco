@extends('admin.layout.main')
@section('title')
hỉnh sửa mã giảm giá
@endsection
@section('content')
    <div class="header-page">
        <h1 class="h3 mb-3">Chỉnh sửa mã giảm giá</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('code.update', $code->id) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Tên <span style="color:red;">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên" value="{{old('name') ? old('name') : $code->name}}"

                                >
                                @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Code <span style="color:red;">*</span></label>
                                <input type="text" name="code" class="form-control" placeholder="Nhập code" value="{{old('code') ? old('code') : $code->code}}"

                                >
                                @error('code')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                @if(Session::has('codeExist'))
                                    <span class="error text-danger">{{ Session::get('codeExist') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="form-label">Số lượng </label>
                                <input type="number" name="total" class="form-control" placeholder="Nhập số lượng"
                                       onkeypress="return isNumberKey(event)" value="{{old('total') ? old('total') : $code->total}}"
                                >
                                @error('total')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Đã dùng </label>
                                <input type="number" name="used" class="form-control" placeholder="Nhập số lượng đã dùng"
                                       onkeypress="return isNumberKey(event)" value="{{old('used') ? old('used') : $code->used}}"
                                >
                                @error('used')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label class="form-label">Số giảm</label>
                                <input type="number" name="number" class="form-control" placeholder="Nhập số"
                                       onkeypress="return isNumberKey(event)" value="{{old('number') ? old('number') : $code->number}}"
                                >
                                @error('number')
                                <span class="error text-danger" >{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label class="form-label">Ngày bắt đầu <span style="color:red;">*</span></label>--}}
{{--                                <input type="date" name="date_start" class="form-control"--}}
{{--                                       value="{{old('date_start') ? old('date_start') : $code->date_start}}"--}}
{{--                                >--}}
{{--                                @error('date_start')--}}
{{--                                <span class="error text-danger">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label class="form-label">Ngày kết thúc <span style="color:red;">*</span></label>--}}
{{--                                <input type="date" name="date_end" class="form-control"--}}
{{--                                       value="{{old('date_end') ? old('date_end') : $code->date_end}}"--}}
{{--                                >--}}
{{--                                @error('date_end')--}}
{{--                                <span class="error text-danger">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState">Hình thức giảm <span style="color:red;">*</span></label>
                                <select id="inputState" class="form-control" name="type">
                                    @if($code->type == 1)
                                        <option value="1" selected>Giảm theo phần trăm</option>
                                        <option value="2">Giảm theo tiền</option>
                                    @else
                                        <option value="2" selected>Giảm theo tiền</option>
                                        <option value="1">Giảm theo phần trăm</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Trạng thái</label>
                                <select id="inputState" class="form-control" name="status">
                                    @if($code->status == 1)
                                        <option value="1" selected>Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    @else
                                        <option value="0" selected>Không hoạt động</option>
                                        <option value="1">Hoạt động</option>
                                    @endif
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

