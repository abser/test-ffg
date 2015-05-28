
<div class="form-group">	
	{{ Form::label('club_id', 'Club', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::select('club_id', $clubs, Input::old('club_id'), array('id' => 'club_id', 'class'=>'form-control', 'required'=>'required')); }}
    	@if ($errors->has('club_id')) <p class="alert alert-danger">{{ $errors->first('club_id') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('name', 'Room Name', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('name', Input::old('name'), ['class'=>'form-control', 'placeholder'=>'service name', 'required'=>'required']) }}
    	@if ($errors->has('name')) <p class="alert alert-danger">{{ $errors->first('name') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('room_number', 'Room Number', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('room_number', Input::old('room_number'), ['class'=>'form-control', 'placeholder'=>'room number', 'required'=>'required']) }}
    	@if ($errors->has('room_number')) <p class="alert alert-danger">{{ $errors->first('room_number') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('service', 'Service Selection', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">  
    	{{ Form::text('service', Input::old('service'), ['class'=>'form-control', 'placeholder'=>'service']) }}  	
    	@if ($errors->has('room_number')) <p class="alert alert-danger">{{ $errors->first('room_number') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('capacity', 'Capacity', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('capacity', Input::old('capacity'), ['class'=>'form-control', 'placeholder'=>'capacity', 'required'=>'required']) }}
    	@if ($errors->has('capacity')) <p class="alert alert-danger">{{ $errors->first('capacity') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	{{ Form::checkbox('is_conjunct', '1', Input::old('is_conjunct'), ['id'=>'is_conjunct']) }}
    	<label for="is_conjunct" class="control-label">This room is conjunct with other room.</label>
    </div>
</div>
<div  class="form-group" id="conjunct_box" style="display: none">	
	{{ Form::label('conjunct[]', 'Select Conjunct Room', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	<p style="background-color: grey;">This room is conjunct with below selected rooms, This room will be booked with selected rooms, This room can has overlapping booking if only any of the selected room is available</p>
    	<div>
    		{{ Form::select('conjunct[]', $clubs, Input::old('conjunct[]'), array('id' => 'conjunct', 'class'=>'form-control', 'multiple'=>'multiple')); }}
    		@if ($errors->has('conjunct[]')) <p class="alert alert-danger">{{ $errors->first('conjunct[]') }}</p> @endif
    	</div>
    </div>
</div>

<div class="form-group">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	<button type="submit" class="btn btn-default">Save Room</button>
    	<a href="{{ URL::route('room.index') }}"><button type="button" class="btn">Cancel</button></a>
    </div>
</div>