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
    {{ HTML::script('/assets/js/vendor/modernizr-2.8.3.min.js') }}    
    
    @yield('css')
</head>
<body class="body_bg">
<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="main_container">
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<!--login modal-->
			<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
				<div class="">
				<div class="modal-header">
					<h1 class="text-center"><img src="{{ asset('assets/images/logo_login.png') }}" alt="logo Gravitys" title="Gravity" ></h1>
				</div>
				<div class="modal-body">
					{{ Form::open(array("route"=>"index", "autocomplete" => "off", "class"=>"form col-md-12 center-block login" )) }}
						<div class="input-group">
							<div class="input-group-addon">Username</div>
							{{ Form::text("email", Input::get("email"), array("placeholder" => "email@domain.com", "class"=>"form-control input-lg" )) }}
						</div>
						<div class="input-group">
							<div class="input-group-addon">Password</div>
							{{ Form::password("password", array("placeholder" => "password", "class"=>"form-control input-lg")) }}
						</div>
						<div class="form-group margin_top">
							<span class="pull-right"><input type="checkbox" value="remember-me"></span> <span class="remember_text">Remember me </span>
						</div>
						<div class="form-group">
							<button class="btn  btn-primary btn-block">Sign In</button>
							<span><a href="{{URL::route('auth.request')}}" class="forget_pass center-block">Forgot your password?</a></span>
						</div>
					{{ Form::close() }}
				</div>
				</div>
				</div>
			</div><!--login modal End-->
		</div>
	</div>
</div>
</div><!-- main container end here -->

{{ HTML::script('/assets/js/jquery-2.1.4.min.js') }}    
{{ HTML::script('/assets/js/bootstrap.min.js') }}
{{ HTML::script('/assets/js/plugins.js') }}
{{ HTML::script('/assets/js/jquery.slicknav.js') }}
{{ HTML::script('/assets/js/main.js') }}
</body>
</html>