<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Gravity - @yield('title', 'Home')</title>
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}">
    
    <!-- Place favicon.ico in the root directory -->
    {{ HTML::style('/assets/css/font-awesome.min.css') }}
    {{ HTML::style('/assets/css/bootstrap.min.css') }}
    {{ HTML::style('/assets/css/slicknav.min.css') }}
    {{ HTML::style('/assets/css/fonts.css') }}
    
    {{ HTML::style('/assets/css/normalize.css') }}
    {{ HTML::style('/assets/style.css') }}
    {{ HTML::style('/assets/css/skin-black.min.css') }}
    {{ HTML::script('/assets/js/vendor/modernizr-2.8.3.min.js') }}    
    
    @yield('css')
</head>
<body class="skin-black layout-top-nav">
<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="wrapper">
@include("menubar")

<!-- Full Width Column -->
<div class="content-wrapper">
<div class="container">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Admin Dashboard<small>Panel</small></h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	
	<!-- Main content -->
    <section class="content">
    <div class="box box-default">    	
    	<div class="box-body">             
    		@yield("content")
    	</div>
    </div>
    </section><!-- /.content -->

</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<footer class="main-footer">
	<div class="container">
    	<div class="pull-right hidden-xs">Date: <?php echo date('d-m-Y') ?></div>
    	Copyright &copy; <?php echo date('Y') ?> <strong class="red"> <a href="#">Gravity.</a></strong> All rights reserved.
    </div><!-- /.container -->
</footer>
</div><!-- ./wrapper -->
{{ HTML::script('/assets/js/jquery-2.1.4.min.js') }}    
{{ HTML::script('/assets/js/bootstrap.min.js') }}
{{ HTML::script('/assets/js/plugins.js') }}
{{ HTML::script('/assets/js/jquery.slicknav.js') }}
{{ HTML::script('/assets/js/slimScroll/jquery.slimscroll.min.js') }}
{{ HTML::script('/assets/js/fastclick/fastclick.min.js') }}
{{ HTML::script('/assets/js/app.min.js') }}
{{ HTML::script('/assets/js/demo.js') }}
{{ HTML::script('/assets/js/main.js') }}

@yield('js')
</body>
</html>
