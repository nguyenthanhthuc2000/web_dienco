@extends('admin.layout.main')
@section('content')
    <div class="header-page">
        <h1 class="h3 mb-3">Danh sách sản phẩm</h1>
        <div class="list-btn">
            <a class="btn btn-primary btn__add__href" href=""><i class="fas fa-plus"></i> &nbsp;Thêm mới</a>
        </div>
    </div>
    <br>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Date of Birth</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <img src="/for_admin/img/avatars/avatar-5.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Vanessa Tucker
                    </td>
                    <td>864-348-0485</td>
                    <td>June 21, 1961</td>
                </tr>
                <tr>
                    <td>
                        <img src="/for_admin/img/avatars/avatar-2.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> William Harris
                    </td>
                    <td>914-939-2458</td>
                    <td>May 15, 1948</td>
                </tr>
                <tr>
                    <td>
                        <img src="/for_admin/img/avatars/avatar-3.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Sharon Lessman
                    </td>
                    <td>704-993-5435</td>
                    <td>September 14, 1965</td>
                </tr>
                <tr>
                    <td>
                        <img src="/for_admin/img/avatars/avatar-4.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Christina Mason
                    </td>
                    <td>765-382-8195</td>
                    <td>April 2, 1971</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection

