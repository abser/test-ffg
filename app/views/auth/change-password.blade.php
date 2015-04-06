@extends("layout")
@section("content")
        
<div class="sprim-details-container">

    <div class="row">
        <div class="large-6 columns">
            <h1>Change Password</h1>
            <p>Enter a new password for <b>{{ $email }}</b>. We highly recommend you create a unique password - one that you don't use for any other websites.</p>
        </div>
        
        <div class="large-6 columns">
        
        	{{ Form::open(["route" => "auth.change-password", "autocomplete" => "off"]) }}
        		        		
        		{{ Form::label("current_password", "Current Password") }}
                {{ Form::password("current_password", array("placeholder" => "••••••••••", 'autofocus' => 'autofocus')) }}
                @if ($error = $errors->first("current_password"))
                <small class="error">{{ $error }}</small>
                @endif
        		
        		{{ Form::label("password", "New Password") }}
                {{ Form::password("password", array("placeholder" => "••••••••••")) }}
                @if ($error = $errors->first("password"))
                <small class="error">{{ $error }}</small>
                @endif
                
                {{ Form::label("password_confirmation", "Confirm new password") }}
                {{ Form::password("password_confirmation", array("placeholder" => "••••••••••")) }}
                @if ($error = $errors->first("password_confirmation"))
                <small class="error">{{ $error }}</small>
                @endif               
        		
        		{{ Form::submit("Change Password", ['class' => 'button tiny']) }}
        		
        		<a href="{{ URL::route('index') }}">
        		{{ Form::button("Cancel", array('class' => 'button tiny')) }}
        		</a>
        		
        	{{ Form::close() }}        	
        </div>
    </div>
    
</div>
@stop
