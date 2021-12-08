
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="shortcut icon" href="/img/icons/icon-48x48.png" />

    <title>
         @yield('title')
    </title>

    <link href="/for_admin/css/app.css" rel="stylesheet">
    <link href="/for_admin/css/style.css" rel="stylesheet">
    <link href="/for_admin/css/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    @include('admin.layout.menu')
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle d-flex">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                            <img src="/for_admin/img/avatars/avatar.jpg" class="avatar img-fluid rounded mr-1" alt="Charles Hall" />
                            <span class="text-dark">{{ Auth::user()->name }}</span>
                        </a>
{{--                        <div class="dropdown-menu dropdown-menu-right">dropdown-toggle (class a)--}}
{{--                            <a class="dropdown-item" href="pages-profile.html"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>--}}
{{--                            <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="pie-chart"></i> Analytics</a>--}}
{{--                            <div class="dropdown-divider"></div>--}}
{{--                            <a class="dropdown-item" href="pages-settings.html"><i class="align-middle mr-1" data-feather="settings"></i> Settings & Privacy</a>--}}
{{--                            <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="help-circle"></i> Help Center</a>--}}
{{--                            <div class="dropdown-divider"></div>--}}
{{--                            <a class="dropdown-item" href="#">Log out</a>--}}
{{--                        </div>--}}
                    </li>
                </ul>
            </div>
        </nav>
