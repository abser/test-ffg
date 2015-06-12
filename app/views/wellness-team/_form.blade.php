
<div class="form-group">	
	{{ Form::label('club_id', 'Club', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->club_users)
    		{{ Form::select('clubs[]', $form['clubs'], $form['user']->club_users->lists('club_id'), array('id' => 'clubs', 'multiple'=>true, 'size'=>'3', 'class'=>'form-control', 'required'=>'required')); }}
    	@else
    		{{ Form::select('clubs[]', $form['clubs'], (Input::old('clubs')), array('id' => 'clubs', 'multiple'=>true, 'size'=>'3', 'class'=>'form-control', 'required'=>'required')); }}
    	@endif    	
    	@if ($errors->has('clubs')) <p class="alert alert-danger">{{ $errors->first('clubs') }}</p> @endif
    </div>
</div>
<div class="form-group" style="padding-top: 1em;">
	{{ Form::label('profile_type', 'Profile Type', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	<div class="row">
    		<div class="col-lg-4">
    			{{ Form::radio('profile_type', '1', true); }}
    			{{ Form::label('profile_type', 'Medical Doctor') }}
    		</div>    		
    		<div class="col-lg-4">
    			{{ Form::radio('profile_type', '2'); }}
    			{{ Form::label('profile_type', 'Fitness Coach') }}
    		</div>    		
    		<div class="col-lg-4">
    			{{ Form::radio('profile_type', '3'); }}
    			{{ Form::label('profile_type', 'Wellness Experts') }}
    		</div> 		
    	</div>    	
    </div>
</div>

<div class="form-group">	
	{{ Form::label('profile[title]', 'Title', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->profile)
    		{{ Form::text('profile[title]', $form['user']->profile->title, ['class'=>'form-control', 'placeholder'=>'Title']) }}
    	@else
    		{{ Form::text('profile[title]', Input::old('profile.title'), ['class'=>'form-control', 'placeholder'=>'Title']) }}
    	@endif    	
    	@if ($errors->has('title')) <p class="alert alert-danger">{{ $errors->first('title') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('first_name', 'First Name', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('first_name', Input::old('first_name'), ['class'=>'form-control', 'placeholder'=>'First Name', 'required'=>'required']) }}
    	@if ($errors->has('first_name')) <p class="alert alert-danger">{{ $errors->first('first_name') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('last_name', 'Last Name', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('last_name', Input::old('last_name'), ['class'=>'form-control', 'placeholder'=>'Last name']) }}
    	@if ($errors->has('last_name')) <p class="alert alert-danger">{{ $errors->first('last_name') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('email', 'Email', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::email('email', Input::old('email'), ['class'=>'form-control', 'placeholder'=>'Email', 'required'=>'required']) }}
    	@if ($errors->has('email')) <p class="alert alert-danger">{{ $errors->first('email') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('phone', 'Phone', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('phone', Input::old('phone'), ['class'=>'form-control', 'placeholder'=>'Phone']) }}
    	@if ($errors->has('phone')) <p class="alert alert-danger">{{ $errors->first('phone') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('mobile', 'Mobile', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	<div class="row">
    		<div class="col-lg-6">
    			{{ Form::text('mobile', Input::old('mobile'), ['class'=>'form-control', 'placeholder'=>'Mobile']) }}
    		</div>
    		<div class="col-lg-6">
    			{{ Form::checkbox('mobile_is_private', '1', Input::old('mobile_is_private')) }}
    			<label for="ghcp_appointment" class="control-label">Keep my mobile number private</label>
    		</div>    	
    		@if ($errors->has('mobile')) <p class="alert alert-danger">{{ $errors->first('mobile') }}</p> @endif
    	</div>
    </div>
</div>
<div class="form-group" style="padding-top: 1em;">
	{{ Form::label('address', 'Address', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	<div class="row">
    		<div class="col-lg-4">@include("common.country", ['name' => 'address[country_code]', 'class'=>'form-control'])</div>    		
    		<div class="col-lg-4">{{ Form::select('address[region_id]', array('' => ''), null, array('id' => 'region', 'class'=>'form-control')); }}</div>    		
    		<div class="col-lg-4">
    			@if($form['user'] && $form['user']->profile && $form['user']->profile->address)
    				{{ Form::text('address[city]', $form['user']->profile->address->city, ['class'=>'form-control', 'placeholder'=>'city']) }}
    			@else
    				{{ Form::text('address[city]', Input::old('address.city'), ['class'=>'form-control', 'placeholder'=>'city']) }}
    			@endif    		
    		</div> 		
    	</div>    	
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->profile && $form['user']->profile->address)
    		{{ Form::text('address[address1]', $form['user']->profile->address->address1, ['class'=>'form-control', 'placeholder'=>'address line 1']) }}
    	@else
    		{{ Form::text('address[address1]', Input::old('address.address1'), ['class'=>'form-control', 'placeholder'=>'address line 1']) }}
    	@endif
    	@if ($errors->has('address[address1]')) <p class="alert alert-danger">{{ $errors->first('address[address1]') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->profile && $form['user']->profile->address)
    		{{ Form::text('address[address2]', $form['user']->profile->address->address2, ['class'=>'form-control', 'placeholder'=>'address line 2']) }}
    	@else
    		{{ Form::text('address[address2]', Input::old('address.address2'), ['class'=>'form-control', 'placeholder'=>'address line 2']) }}
    	@endif
    	@if ($errors->has('address[address2]')) <p class="alert alert-danger">{{ $errors->first('address[address2]') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->profile && $form['user']->profile->address)
    		{{ Form::text('address[postal_code]', $form['user']->profile->address->postal_code, ['class'=>'form-control', 'placeholder'=>'postal code']) }}
    	@else
    		{{ Form::text('address[postal_code]', Input::old('address.postal_code'), ['class'=>'form-control', 'placeholder'=>'postal code']) }}
    	@endif
    	@if ($errors->has('address[postal_code]')) <p class="alert alert-danger">{{ $errors->first('address[postal_code]') }}</p> @endif
    </div>
</div>

@include('common.file_form', array('file' => 'profile_pic', 'label' => 'Profile Picture'))

<div class="form-group">
	{{ Form::label('profile[qualification]', 'Qualifications', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->profile)
    		{{ Form::text('profile[qualification]', $form['user']->profile->qualification, ['class'=>'form-control', 'placeholder'=>'qualifications']) }}
    	@else
    		{{ Form::text('profile[qualification]', Input::old('profile.qualification'), ['class'=>'form-control', 'placeholder'=>'qualifications']) }}
    	@endif  
    	@if ($errors->has('profile[qualification]')) <p class="alert alert-danger">{{ $errors->first('profile[qualification]') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<label for="profile[description]" class="col-lg-3 control-label">Personal Philosophy</label>
    <div class="col-lg-9">
    	@if($form['user'] && $form['user']->profile)
    		{{ Form::textarea('profile[description]', $form['user']->profile->description, ['class'=>'form-control', 'placeholder'=>'personal philosophy']) }}
    	@else
    		{{ Form::textarea('profile[description]', Input::old('profile.description'), ['class'=>'form-control', 'placeholder'=>'personal philosophy']) }}
    	@endif 
    	@if ($errors->has('personal philosophy')) <p class="alert alert-danger">{{ $errors->first('personal philosophy') }}</p> @endif
    </div>
</div>
<div class="form-group" style="padding-top: 1em;">
	<div class="col-lg-3">&nbsp;</div>
    <div class="col-lg-9">
    	{{ Form::radio('accept_appointment', '1', false); }}
    	{{ Form::label('accept_appointment', 'This profile don\'t accept appointment') }}    	
    </div>
</div>

<div class="form-group" style="padding-top: 1em;">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	<button type="submit" class="btn btn-default">Save Expert</button>
    	<a href="{{ URL::route('wellness-team.index') }}"><button type="button" class="btn">Cancel</button></a>
    </div>
</div>