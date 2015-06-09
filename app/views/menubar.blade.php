<header class="main-header">
    <nav class="navbar navbar-static-top">
    	<div class="container">
    		<!-- Collect the nav links, forms, and other content for toggling -->
    		<div class="collapse navbar-collapse pull-right" id="navbar-collapse">
            <ul class="nav navbar-nav" id="menu_main">
            	<li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
            	<li class="dropdown">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Gravity Setup <span class="caret"></span></a>
            		<ul class="dropdown-menu" role="menu">
            			<li><a href="{{URL::route('club.index')}}">Club</a></li>
            			<li><a href="{{URL::route('service.index')}}">Service</a></li>
            			<li><a href="{{URL::route('room.index')}}">Room</a></li>
            			<li><a href="{{URL::route('wellness-team.index')}}">Wellness Team</a></li>
            			<li class="divider"></li>
            			<li><a href="#">Users</a></li>
            		</ul>
            	</li>
            	<li><a href="{{URL::route('member.index')}}">Member</a></li>
                <li><a href="#">Appointment</a></li>
                <li><a href="#">Event</a></li>
                <li><a href="#">Message</a></li>
                <li><a href="#">NewsFeed</a></li>
                
            </ul>                    
            </div><!-- /.navbar-collapse -->
            
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu pull-left">
            <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
            	<!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{ asset('assets/images/man.jpg') }}" class="user-image" alt="User Image" />
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">User Name Here {{ \Session::get('user.id'); }}</span>
                </a>
                <ul class="dropdown-menu">
               	<!-- The user image in the menu -->
                  	<li class="user-header">
                   	<img src="{{ asset('assets/images/man.jpg') }}" class="img-circle" alt="User Image" />
                   	<p>User Name Here<small>Member Since Jan. 2015</small></p>
                   	</li>
                   	<!-- Menu Body -->
                   	<li class="user-body"></li>
                   	<!-- Menu Footer-->
                   	<li class="user-footer">
                   		<div class="pull-left">
                   			<a href="#" class="btn btn-default btn-flat">My Profile</a>
                   		</div>
                   		<div class="pull-right">
                   			<a href="{{URL::route('auth.logout')}}" class="btn btn-default btn-flat">Sign out</a>
                   		</div>
                   	</li>
                </ul>
            </li>
            </ul>
            </div><!-- /.navbar-custom-menu -->
        </div><!-- /.container-fluid -->
    </nav>
</header>