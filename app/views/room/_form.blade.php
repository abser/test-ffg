
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
    	{{ Form::text('name', Input::old('name'), ['class'=>'form-control', 'placeholder'=>'room name', 'required'=>'required']) }}
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
    	<div> 
    	<ul class="tree" style="list-style: none;">
    	@foreach($data['categories']  as $key => $value)
    		<li>{{ Form::checkbox('service[category][]', $key) }} &nbsp; {{ $value }}
    			<ul style="list-style: none;">
    			@foreach($data['services']  as $service)
    				@if(!$service->service_sub_category_id  && $key == $service->service_category_id)
    					<?php $checked = false;
    						foreach ($room_services as $_r_service) {
    							if ($service->id == $_r_service->service_id)
    								$checked = true;
    						
    					}?>
    					<li>{{ Form::checkbox('service[id][]', $service->id, $checked) }} &nbsp; {{ $service->name }}</li>
    				@endif  
    			@endforeach
    			
    			@foreach($data['sub_categories']  as $sub_category)
    				@if($sub_category->parent_id == $key)
    					<li>{{ Form::checkbox('service[sub_category][]', $sub_category->id) }} &nbsp; {{ $sub_category->name }}
    					<ul style="list-style: none;">
    					@foreach($data['services']  as $service)
    						@if($sub_category->id == $service->service_sub_category_id)
    							<?php $checked = false;
    						foreach ($room_services as $_r_service) {
    							if ($service->id == $_r_service->service_id)
    								$checked = true;
    						
    					}?>
    							<li>{{ Form::checkbox('service[id][]', $service->id, $checked) }} &nbsp; {{ $service->name }}</li>
    						@endif  
    					@endforeach    									
    					</li>
    				@endif
    			@endforeach
    			</ul>
    		</li>
    	@endforeach
    	</ul>
    	</div>
    	<div id="directoryTree_container"></div>    		
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
	{{ Form::label('room_conjuncts[]', 'Select Conjunct Room', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	<p style="background-color: grey;">This room is conjunct with below selected rooms, This room will be booked with selected rooms, This room can has overlapping booking if only any of the selected room is available</p>
    	<div>
    		{{ Form::select('room_conjuncts[]', $rooms, Input::old('room_conjuncts[]'), array('id' => 'room_conjuncts', 'class'=>'form-control', 'multiple'=>'multiple')); }}
    		@if ($errors->has('room_conjuncts[]')) <p class="alert alert-danger">{{ $errors->first('room_conjuncts[]') }}</p> @endif
    	</div>
    </div>
</div>

<div class="form-group" style="padding-top: 1em;">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	<button type="submit" class="btn btn-default">Save Room</button>
    	<a href="{{ URL::route('room.index') }}"><button type="button" class="btn">Cancel</button></a>
    </div>
</div>