
<footer class="footer_area clearfix">
    <div class="container">
        <div class="row align-items-center">
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-4">
                <div class="single_widget_area">
                    <!-- Logo -->
                    <div class="footer-logo mr-50">
                        <a href="{{ route('users.index') }}"><img src="/for_users/img/core-img/logo2.png" alt=""></a>
                    </div>
                    <!-- Copywrite Text -->
{{--                    <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->--}}
{{--                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>--}}
{{--                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>--}}
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-8">
                <div class="single_widget_area">
                    <!-- Footer Menu -->
                    <br>
                    <div class="footer_menu">
                        <nav class="navbar navbar-expand-lg justify-content-end">
{{--                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>--}}
                            <div class=" navbar-collapse" id="footerNavContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ route('users.index') }}">Trang ch???</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.product') }}">C???a h??ng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.cart') }}">Gi??? h??ng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.checkout') }}">Thanh to??n</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="https://www.facebook.com/Tr%E1%BB%8Bnh-Tuy%E1%BA%BFt-Ng%C3%A2n-100475668476025/">Li??n h???</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="/for_users/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="/for_users/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="/for_users/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="/for_users/js/plugins.js"></script>
<!-- Active js -->
<script src="/for_users/js/active.js"></script>

<script src="/vendor/js/sweetalert2.min.js"></script>
@stack('active')
@stack('js')
<script>
    $(".amado-nav li a").filter(function(){
        return this.href == location.href;
    }).parents("li").addClass("active");

    function isNumberKey(event){
        var charCode =(event.which) ? event.which : event.keyCode
        if(charCode >31 &&(charCode <48 || charCode >57))
            return false;
        return true;
    }
</script>
<script type="text/javascript">

		$('.add-cart').click(function(){
		    var url = $(this).data('url');
			var id = $(this).data('id');
            var cart_product_qty = $('.cart_product_qty_' +id).val();
			if( $(this).data('sl') == '0'){
    			Swal.fire(
				  'S???n ph???m ???? h???t h??ng!',
				  'Vui l??ng quay l???i sau! Ho???c LH shop ????? ???????c t?? v???n',
				  'error'
				)
			}
			else if($(this).data('price') == '0'){
    			Swal.fire(
				  'Li??n h??? ch??? shop!',
				  'Li??n h??? ch??? CSKH ????? ???????c b??o gi??',
				  'error'
				)
			}
			else{
			    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
				 $.ajax({
                	url: url,
                	method:'POST',
                	data:{id:id,cart_product_qty:cart_product_qty},
                	success:function(data){

                	    const myObj = JSON.parse(JSON.stringify(data))
                        x = myObj.total;
                		if(x != null){
                            $('.total-product').text(x);
                			Swal.fire(
							  'Th??m gi??? h??ng th??nh c??ng!',
							  'Ti???p t???c mua h??ng!',
							  'success'
							)
                		}else{
                			Swal.fire(
							  'Th???t b???i!',
							  'Th??? l???i sau!',
							  'error'
							)
                		}
                	}
                })
			}
		})
	</script>
