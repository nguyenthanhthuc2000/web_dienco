@extends('admin.layout.main')
@section('title')
    Lịch sử hoạt động
@endsection
@section('content')
    @include('admin.layout.alert')
    <div class="header-page">
        <h1 class="h3 mb-3">Lịch sử hoạt động</h1>
        <div class="list-btn">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>Ngày tạo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($historys->count() > 0)
                        @foreach($historys as $history)
                            <tr>
                                <td>
                                    {{$history->user->name}}
                                </td>
                                <td>
                                    {{$history->user->email}}
                                </td>
                                <td>
                                    {{$history->action}}
                                </td>
                                <td>{{$history->created_at}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <strong> Không có dữ liệu</strong>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="float-right" style="    display: flex;
    justify-content: end;
    padding-top: 15px;">
                    {{ $historys->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
