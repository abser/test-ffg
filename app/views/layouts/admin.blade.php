<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', 'Gravity')</title>
    <link rel="icon" href="icon.png">
    
    <!-- Place favicon.ico in the root directory -->
    {{ HTML::style('/assets/css/font-awesome.min.css') }}
    {{ HTML::style('/assets/css/bootstrap.min.css') }}
    {{ HTML::style('/assets/css/slicknav.min.css') }}
    
    {{ HTML::style('/assets/css/normalize.css') }}
    {{ HTML::style('/assets/style.css') }}
    {{ HTML::script('/assets/js/vendor/modernizr-2.8.3.min.js') }}
    
    @yield('css')
</head>
<body>
<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

@include("menubar")

<div class="container-fluid">	
	<div class="row-fluid">
		<div class="span12">
        	@if (Session::has('success'))
        		<div data-alert class="alert-box success">{{ Session::get('success') }}</div>
        	@endif
        	@if (Session::has('message'))
        		<div data-alert class="alert-box success">{{ Session::get('message') }}</div>
        	@endif
        	@if (Session::has('warning'))
        		<div data-alert class="alert-box warning">{{ Session::get('warning') }}</div>
        	@endif
        	@if (Session::has('error'))
        		<div data-alert class="alert-box alert">{{ Session::get('error') }}</div>
        	@endif
        </div>
    </div>
    <div class="row-fluid main">
    	<div class="col-lg-12 col-md-12 col-xs-12">@yield("content")</div>
    </div>
</div>
@include("footer")
</body>
</html>
