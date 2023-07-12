<!DOCTYPE html>
<html lang="zxx">
<head>
		<meta charset="utf-8" />
		<meta name="author" content="Themezhub" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kumo- Fashion eCommerce HTML Template</title>

        <!-- Custom CSS -->
        @include('frontend.include.style')
        @stack('css')
		
    </head>
	
    <body>
	
		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
       <div class="preloader"></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
		
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
			@include('frontend.include.header')
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			@yield('body')
			
			
			<!-- ============================ Footer Start ================================== -->
			@include('frontend.include.footer')
			<!-- ============================ Footer End ================================== -->
			
            <!-- ===== whishlist and cart page ===== -->
			@include('frontend.include.default')
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		@include('frontend.include.script')
        @stack('js')

	</body>

</html>