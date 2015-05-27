<!-- @if ($errors->has())
	<div class="alert alert-danger">
	@foreach ($errors->all() as $error)
		{{ $error }}<br>
	@endforeach
	</div>
@endif -->


<div class="form-group">	
	{{ Form::label('name', 'Club Name', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
    	{{ Form::text('name', Input::old('name'), ['class'=>'form-control', 'placeholder'=>'club name', 'required'=>'required']) }}
    	@if ($errors->has('name')) <p class="alert alert-danger">{{ $errors->first('name') }}</p> @endif
    </div>
</div>
<div class="form-group" style="padding-top: 1em;">
	{{ Form::label('address', 'Address', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
    	<div class="row">
    		<div class="col-lg-4">@include("common.country", ['name' => 'address[country_code]', 'class'=>'form-control'])</div>    		
    		<div class="col-lg-4">{{ Form::select('address[region_id]', array('' => ''), null, array('id' => 'region', 'class'=>'form-control')); }}</div>    		
    		<div class="col-lg-4">{{ Form::text('address[city]', Input::old('address.city'), ['class'=>'form-control', 'placeholder'=>'city']) }}</div> 		
    	</div>    	
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
    	{{ Form::text('address[address1]', Input::old('address.address1'), ['class'=>'form-control', 'placeholder'=>'address line 1']) }}
    	@if ($errors->has('address[address1]')) <p class="alert alert-danger">{{ $errors->first('address[address1]') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
    	{{ Form::text('address[address2]', Input::old('address.address2'), ['class'=>'form-control', 'placeholder'=>'address line 2']) }}
    	@if ($errors->has('address[address2]')) <p class="alert alert-danger">{{ $errors->first('address[address2]') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
    	{{ Form::text('address[postal_code]', Input::old('address.postal_code'), ['class'=>'form-control', 'placeholder'=>'postal code']) }}
    	@if ($errors->has('address[postal_code]')) <p class="alert alert-danger">{{ $errors->first('address[postal_code]') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<label for="description" class="col-lg-2 control-label">Description</label>
    <div class="col-lg-10">
    	{{ Form::textarea('description', Input::old('description'), ['class'=>'form-control', 'placeholder'=>'club description', 'rows'=>'3']) }}
    	@if ($errors->has('description')) <p class="alert alert-danger">{{ $errors->first('description') }}</p> @endif
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2"></div>
    <div class="col-lg-10">
    	<button type="submit" class="btn btn-default">Save Club</button>
    	<a href="{{ URL::route('club.index') }}"><button type="button" class="btn">Cancel</button></a>
    </div>
</div>



