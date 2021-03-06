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
    {{ HTML::style('/assets/site_style.css') }}
	{{ HTML::script('/assets/js/vendor/modernizr-2.8.3.min.js') }}
	
	@yield('css')
</head>
<body>
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main_container">
<header>
    <div class="header_inner">
    <div class="container">
    	<div class="row">
    		<div class="col-md-12 right_top_menu ">
    		<ul class="list-inline pull-right">
    		<li class="menu_rght"><a href="#" >{{ \Session::get('user.full_name'); }}</a>
    			<ul class="sub-menu">
    				<li><a href="#">Profile</a></li>
    				<li><a href="#">Settings</a></li>
    				<li><a href="{{URL::route('auth.logout')}}">Log Out</a></li>
    			</ul>
    		</li>
    		<li><a href="#"><i class="fa fa-clock-o"></i></a></li>
    		<li><a href="#"><i class="fa fa-envelope"></i> <span class="badge">3</span></a></li>
    		</ul>
    		</div>
    	</div>
    	
    	<div class="row">
    		<div class="col-md-4">
    			<div class="logo_area">
    				<a href="#"><img src="{{ asset('assets/images/logo_gravity.png') }}" alt="logo" title="Gravity" ></a>
    			</div>
    		</div>
    		<div class="col-md-8">
    			<nav class="pull-right">
    			<ul id="menu" class="list-inline">
    				<li><a href="#">HEALTH INDEX</a></li>
    				<li><a href="#" class="active">WELLNESS TEAM</a></li>
    				<li><a href="#">APPOINTMENT</a></li>
    				<li><a href="#">SOCIAL</a></li>
    				<li><a href="#">RESTAURANT</a></li>
    				<li><a href="#">NEWS</a></li>
    			</ul>
    			</nav>
    		</div>
    	</div>
    </div>
    </div>
</header><!-- Header section end here -->

@yield("content")

<footer>
	<div class="container">
		<div class="footer_inner">
			<p>DOWNLOAD GRAVITY APP ON IOS & ANDROID</p>
			<ul class="list-inline">
				<li><a href="#"><img src="{{ asset('assets/images/apps_store_icon.png') }}" alt="banner" class="img-responsive" ></a></li>
				<li><a href="#"><img src="{{ asset('assets/images/google_play.png') }}" alt="banner" class="img-responsive" ></a></li>
			</ul>
			<nav>
				<ul class="list-inline">
					<li><a href="#">ABOUT GRAVITY</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Career</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms & Conditions</a></li>
				</ul>
			</nav>
		    <p class="copyright">&copy; 2015 GRAVITY  &nbsp;|&nbsp; FITNESS FIRST GROUP</p>
		</div>
	</div>
</footer><!-- Footer section end here -->
        
</div><!-- main container end here -->

{{ HTML::script('/assets/js/jquery-2.1.4.min.js') }}    
{{ HTML::script('/assets/js/bootstrap.min.js') }}
{{ HTML::script('/assets/js/plugins.js') }}
{{ HTML::script('/assets/js/jquery.slicknav.js') }}       
{{ HTML::script('/assets/js/main.js') }}

@yield('js')
</body>
</html>