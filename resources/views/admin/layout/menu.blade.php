
<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav main-menu">
            <li class="sidebar-header">
               Danh mục
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('order.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Đơn hàng</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('product.index') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Sản phẩm</span>
                </a>
            </li>
            @if(Auth::user()->level == 1)
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('category.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Danh mục</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('code.index') }}">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Mã giảm giá</span>
                </a>
            </li>
            @endif
                <li class="sidebar-header">
                    Quản lí
                </li>
                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('product.comment') }}">
                    <i class="fas fa-comment"></i> <span class="align-middle">Bình luận</span>
                </a>
            </li>
            @if(Auth::user()->level == 1)
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('user.index') }}">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Nhân viên</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('history.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Lịch sử hoạt động</span>
                </a>
            </li>
            @endif
            <li class="sidebar-header">
                Tài khoản
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.change.password') }}">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Đổi mật khẩu</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.logout') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Đăng xuất</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
