<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)">Gravity</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
        <ul class="nav navbar-nav">
        	<li><a href="javascript:void(0)">Dashboard</a></li>       
            <li class="active dropdown">
                <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Gravity Setup <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{URL::route('club.index')}}">Club</a></li>
                    <li><a href="{{URL::route('service.index')}}">Service</a></li>
                    <li><a href="{{URL::route('room.index')}}">Room</a></li> 
                    <li><a href="">Wellness Team</a></li>
                    <li><a href="">Users</a></li>
                </ul>
            </li>
            <li><a href="">Member</a></li>
            <li><a href="">Group</a></li>
            <li><a href="">Appointment</a></li>
            <li><a href="">Event</a></li>
            <li><a href="">Message</a></li>
            <li><a href="">News Feed</a></li>
        </ul>       
    </div>
</div>