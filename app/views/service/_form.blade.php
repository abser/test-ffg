
<div class="form-group">	
	{{ Form::label('club_id', 'Club', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::select('club_id', $clubs, Input::old('club_id'), array('id' => 'club_id', 'class'=>'form-control')); }}
    	@if ($errors->has('name')) <p class="alert alert-danger">{{ $errors->first('name') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('name', 'Service Name', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::text('name', Input::old('name'), ['class'=>'form-control', 'placeholder'=>'service name', 'required'=>'required']) }}
    	@if ($errors->has('name')) <p class="alert alert-danger">{{ $errors->first('name') }}</p> @endif
    </div>
</div>
<div class="form-group">	
	{{ Form::label('service_category_id', 'Service Category', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	{{ Form::select('service_category_id', $categories, Input::old('service_category_id'), array('id' => 'service_category_id', 'class'=>'form-control')); }}
    	@if ($errors->has('service_category_id')) <p class="alert alert-danger">{{ $errors->first('service_category_id') }}</p> @endif
    </div>
</div>
<!-- <div class="form-group">	 -->
<!-- 	{{ Form::label('service_category_id', 'Service Sub-Category', array('class' => 'col-lg-3 control-label')) }} -->
<!--     <div class="col-lg-9"> -->
<!--     	{{ Form::select('service_category_id', $categories, Input::old('service_category_id'), array('id' => 'service_category_id', 'class'=>'form-control')); }} -->
<!--     	@if ($errors->has('service_category_id')) <p class="alert alert-danger">{{ $errors->first('service_category_id') }}</p> @endif -->
<!--     </div> -->
<!-- </div> -->


<div class="form-group">
	<label for="description" class="col-lg-3 control-label">Service Description</label>
    <div class="col-lg-9">
    	{{ Form::textarea('description', Input::old('description'), ['class'=>'form-control', 'placeholder'=>'service description', 'rows'=>'3']) }}
    	@if ($errors->has('description')) <p class="alert alert-danger">{{ $errors->first('description') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<label for="description" class="col-lg-3 control-label">Cancellation Notes</label>
    <div class="col-lg-9">
    	{{ Form::textarea('cancellation_notes', Input::old('cancellation_notes'), ['class'=>'form-control', 'placeholder'=>'cancellation notes', 'rows'=>'3']) }}
    	@if ($errors->has('cancellation_notes')) <p class="alert alert-danger">{{ $errors->first('cancellation_notes') }}</p> @endif
    </div>
</div>
<div class="form-group" style="padding-top: 1em;">
	{{ Form::label('cancellation_notice_period', 'Cancellation Notice Period', array('class' => 'col-lg-3 control-label')) }}
    <div class="col-lg-9">
    	<div class="row">
    		<div class="col-lg-4">{{ Form::number('cancellation_notice_period', Input::old('cancellation_notice_period'), ['class'=>'form-control', 'placeholder'=>'']) }}</div>
    		<!-- <div class="col-lg-1"></div> -->
    		<div class="col-lg-7">hours</div> 		
    	</div>    	
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	{{ Form::checkbox('ghcp_appointment', '1', Input::old('ghcp_appointment')) }}
    	<label for="ghcp_appointment" class="control-label">Service needs an GHCP appointment</label>
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	{{ Form::checkbox('only_ghcp', '1', Input::old('only_ghcp')) }}
    	<label for="only_ghcp" class="control-label">Only GHCP can view this Service and create appointment</label>
    </div>
</div>
<div class="form-group">
	<div class="col-lg-3"></div>
    <div class="col-lg-9">
    	<button type="submit" class="btn btn-default">Save Service</button>
    	<a href="{{ URL::route('service.index') }}"><button type="button" class="btn">Cancel</button></a>
    </div>
</div>