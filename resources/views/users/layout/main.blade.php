<!DOCTYPE html>
<html lang="en">

    @include('users.layout.head')

<body>
    
    <div class="main-content-wrapper d-flex clearfix">
        <!-- ##### Menu Start ##### -->
        @include('users.layout.menu')
        <!-- ##### Menu End ##### -->

        <!-- ##### Main Content Wrapper Start ##### -->
        @yield('content')
        <!-- ##### Main Content Wrapper End ##### -->

    </div>
    <section class="newsletter-area section-padding-100-0">
    </section>
    <!-- ##### Footer Area Start ##### -->
    @include('users.layout.footer')
    <!-- ##### Footer Area End ##### -->
    
    @include('users.layout.modal')
</body>

</html>