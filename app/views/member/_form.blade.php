<!-- @if ($errors->has())
        <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
                {{ $error }}<br>
        @endforeach
        </div>
@endif -->

<div class="form-group">	
    {{ Form::label('club_id', 'Club', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{ Form::select('club_id', $data['clubs'], Input::old('club_id'), array('id' => 'club_id', 'class'=>'form-control', 'required'=>'required')); }}
        @if ($errors->has('club_id')) <p class="alert alert-danger">{{ $errors->first('club_id') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('first_name', 'First Name', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::text('first_name', Input::old('first_name'),  array('class'=>'form-control','placeholder' => 'First name','required' => 'required'))}}
        @if ($errors->has('first_name')) <p class="alert alert-danger">{{ $errors->first('first_name') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('last_name', 'Last Name', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::text('last_name', Input::old('last_name'),  array('class'=>'form-control','placeholder' => 'Last name','required' => 'required'))}}
        @if ($errors->has('last_name')) <p class="alert alert-danger">{{ $errors->first('last_name') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('member_email', 'Email', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::email('member_email', Input::old('member_email'),  array('class'=>'form-control','placeholder' => 'Email','required' => 'required'))}}
        @if ($errors->has('member_email')) <p class="alert alert-danger">{{ $errors->first('member_email') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('member_phone', 'Phone', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::number('member_phone', Input::old('member_phone'),  array('class'=>'form-control','placeholder' => 'Phone','required' => 'required'))}}
        @if ($errors->has('member_phone')) <p class="alert alert-danger">{{ $errors->first('member_phone') }}</p> @endif
    </div>
</div>  


<div class="form-group">	
    {{ Form::label('member_mobile', 'Mobile', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::number('member_mobile', Input::old('member_mobile'),  array('class'=>'form-control','placeholder' => 'Mobile','required' => 'required'))}}
        @if ($errors->has('member_mobile')) <p class="alert alert-danger">{{ $errors->first('member_mobile') }}</p> @endif
    </div>
</div>  

<div class="form-group">	
    <label for="gender" class="col-lg-2 control-label">Gender</label>
    <div class="col-lg-10">
        {{  Form::select('gender', array('' => 'Select Gender','M' => 'Male','F' => 'Female'),'default',array('class'=>'form-control','placeholder' => 'Gender','required' => 'required'))}}
        @if ($errors->has('gender')) <p class="alert alert-danger">{{ $errors->first('gender') }}</p> @endif
    </div>
</div> 


<div class="form-group">
    <label for="age_group" class="col-lg-2 control-label">Age Group</label>
    <div class="col-lg-10">
        {{  Form::select('age_group', array('' => 'Select Age Group','g1' => '20-30', 'g2' => '30-40','g3' => '30-40', 'g4' => '40-50'),'default',array('class'=>'form-control','placeholder' => 'age_group','required' => 'required'))}}
        @if ($errors->has('age_group')) <p class="alert alert-danger">{{ $errors->first('age_group') }}</p> @endif
    </div>
</div>
<div class="form-group">	
    {{ Form::label('occupation', 'Occupation', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::text('occupation', Input::old('occupation'),  array('class'=>'form-control','placeholder' => 'Occupation','required' => 'required'))}}
        @if ($errors->has('occupation')) <p class="alert alert-danger">{{ $errors->first('occupation') }}</p> @endif
    </div>
</div>


<div class="form-group">	
    {{ Form::label('member_hobbies', 'Interest / Hobbies', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::text('member_hobbies', Input::old('member_hobbies'),  array('class'=>'form-control','placeholder' => 'Interest / Hobbies'))}}

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
        {{ Form::text('address1', Input::old('address1'), ['class'=>'form-control', 'placeholder'=>'address line 1']) }}
        @if ($errors->has('address1')) <p class="alert alert-danger">{{ $errors->first('address1') }}</p> @endif
    </div>
</div>
<div class="form-group">
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
        {{ Form::text('address2', Input::old('address2'), ['class'=>'form-control', 'placeholder'=>'address line 2']) }}
        @if ($errors->has('address2')) <p class="alert alert-danger">{{ $errors->first('address2') }}</p> @endif
    </div>
</div>
<div class="form-group">
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
        {{ Form::text('postalCode', Input::old('postalCode'), ['class'=>'form-control', 'placeholder'=>'postal code']) }}
        @if ($errors->has('postalCode')) <p class="alert alert-danger">{{ $errors->first('postalCode') }}</p> @endif
    </div>
</div>
<div class="form-group">
    <label for="image" class="col-lg-2 control-label">Picture</label>
    <div class="col-lg-10">
        {{ Form::file('image', ['id'=>'','class' => 'field']) }}


        <div class="small-9 columns">
            &nbsp;&nbsp;    You can upload JPEG,GIP and PNG images     &nbsp;&nbsp;     {{Form::checkbox('display_pic','1',false,array('class'=>'checkdisplayClass','id'=>'display_pic'))}} Display profile picture
        </div>


    </div>
</div>

<div class="form-group">
    <div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">{{Form::checkbox('change_def_pass','1',true,array('class'=>'change_def_pass_class','id'=>'change_def_pass_id'))}} 
        Change Default Password</div>
</div>



<div class="form-group">
    <label for="pa_id" class="col-lg-2 control-label">Personal Assisstant</label>
    <div class="col-lg-10">
        {{Form::select('PaId',  array('' => 'Select PA') + $data['paId'],'default',array('id'=>'pa_id'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-2"></div>
    <div class="col-lg-10">
        <button type="submit" class="btn btn-default">Save Member</button>
        <a href="{{ URL::route('member.index') }}"><button type="button" class="btn">Cancel</button></a>
    </div>
</div>



