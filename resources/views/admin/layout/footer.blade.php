<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-left">
                <p class="mb-0">
                    <a href="#" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
                </p>
            </div>
            <div class="col-6 text-right">
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="/for_admin/js/vendor.js"></script>
<script src="/for_admin/js/app.js"></script>
<script src="/for_admin/js/script.js"></script>
<script src="/for_admin/js/sweetalert2.min.js"></script>
<script>
        {{--active menu--}}
		$(".main-menu li a").filter(function(){
			return this.href == location.href;
		}).parents("li").addClass("active");
</script>
{{--    Nhận js từ @push('js')--}}
@stack('js')
</body>

</html>
