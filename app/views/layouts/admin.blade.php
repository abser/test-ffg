<!doctype html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="image/x-icon" href="{{asset('images/favicon.ico');}}" rel="icon">
    <title>@yield('title', 'Gravity')</title>
    {{ HTML::style('/assets/css/app.min.css') }} 
    <style>
    .fullWidth {width: 100%; margin-left: auto; margin-right: auto; max-width: initial; }
    </style>
    @yield('css')
    {{ HTML::script('/assets/js/header.js') }}
</head>
<body class="antialiased">
	<div id="root">
		<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap">
				<section role="main">
					<div class="row fullWidth">
						<div class="large-12 columns">@include("menubar")</div>
					</div>				
					<div class="row fullWidth">
						<div class="large-12 columns" style="padding-top: 1em;">
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
					<div class="row fullWidth">
						<div class="large-12 columns">@yield("content")</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	@include("footer")
</body>
</html>
