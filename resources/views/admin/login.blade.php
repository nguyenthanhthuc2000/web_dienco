<!doctype html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/for_login_admin/css/style.css">

</head>
<body class="img js-fullheight" style="background-image: url(/for_login_admin/images/bg.jpg);">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">ĐĂNG NHẠP ADMIN</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form action="{{ route('admin.post.login') }}" class="signin-form" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                            @error('email')
                            <span class="error text-white" style="    font-style: italic;font-size: small;    background: #33333333;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" placeholder="Password" name="password" required>
                            @error('password')
                            <span class="error text-white" style="    font-size: small;font-size: small;    background: #33333333;">{{ $message }}</span>
                            @enderror
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Đăng nhập</button>
                        </div>
                        @if(Session::has('error'))
                            <span class="error text-white">{{ Session::get('error') }}</span>
                        @endif
                        <div class="form-group d-md-flex">
{{--                            <div class="w-50">--}}
{{--                                <label class="checkbox-wrap checkbox-primary">Nhớ mật khẩu--}}
{{--                                    <input type="checkbox" checked>--}}
{{--                                    <span class="checkmark"></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="w-50 text-md-right">--}}
{{--                                <a href="#" style="color: #fff">Quên mật khẩu</a>--}}
{{--                            </div>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/for_login_admin/js/jquery.min.js"></script>
<script src="/for_login_admin/js/popper.js"></script>
<script src="/for_login_admin/js/bootstrap.min.js"></script>
<script src="/for_login_admin/js/main.js"></script>

</body>
</html>

