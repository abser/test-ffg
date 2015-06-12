@extends("layouts.member")
@section("content")

<section>
<div class="banner_inner">
	<div class="carousel-inner">
		<div class="item active">
			<img src="{{ asset('assets/images/banner2.jpg') }}" alt="banner" class="img-responsive" >
			<div class="container">
			<div class="carousel-caption">
				<h1 class="text">WELLNESS TEAM</h1>
				<p class="subline">Lorem ipsum dolor sit amet, consectetur adipiscing elit pellentesque quis turpis vel tellus sodales scelerisque ac id metus. Quisque nec nunc enim.</p>
			</div>
			</div>
		</div>
	</div>
</div>
</section><!-- Banner section end here -->

<section class="main_area">
<div class="container">
	<div class="filter_menu center-block ">
		<ul id="menu" class="nav nav-pills ">
			<li><a href="#" class="active">ALL</a></li>
			<li class="menu_rght"><a href="#">MY LIST</a>
			<ul class="sub-menu menu_width">
				<li><a href="#">Coach</a></li>
				<li><a href="#">Group Exercise Instructor</a></li>
			</ul>
			</li>
			<li><a href="#">FITNESS</a></li>
			<li><a href="#">MEDICAL</a></li>
			<li><a href="#">OTHER WELLNESS</a></li>
		</ul>
	</div>
	
	<div class="team_member_inner">
	<div class="row">	
	@foreach($data['items'] as $row)		
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div class="profile_bg"><img src="{{ asset('assets/images/man.jpg') }}" alt="" class="img clip-hex thumb"></div>
				<div class="caption">
					<h2>{{ $row->title.' '.$row->first_name.' '.$row->last_name }} </h2>
					<h3>Fitness Group exercise instructor</h3>
					<p>{{ $row->description }}</p>
					<p><a href="#" class="view_link">View complete profile </a></p>
					<a href="#" class="btn btn-primary center-block" role="button">REQUEST APPOINTMENT</a>
				</div>
			</div>
		</div>
	@endforeach
	</div>
	
	</div>
</div>
</section><!-- team member section end here -->


@stop