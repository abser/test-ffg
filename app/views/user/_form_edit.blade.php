<!-- @if ($errors->has())
        <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
                {{ $error }}<br>
        @endforeach
        </div>
@endif -->
<?php echo '<pre>'; print_r($data); echo '</pre>';?>
<style>

    .chekbox_heading{ background:#333; color:#fff; padding:5px; margin-top:0; margin-bottom:5px; }
</style>

<div class="form-group">	
    {{ Form::label('first_name', 'First Name', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::text('first_name',$data['user'][0]->first_name,  array('class'=>'form-control','placeholder' => 'First name','required' => 'required'))}}
        @if ($errors->has('first_name')) <p class="alert alert-danger">{{ $errors->first('first_name') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('last_name', 'Last Name', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::text('last_name',  $data['user'][0]->last_name,  array('class'=>'form-control','placeholder' => 'Last name','required' => 'required'))}}
        @if ($errors->has('last_name')) <p class="alert alert-danger">{{ $errors->first('last_name') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('member_email', 'Email', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::email('member_email',  $data['user'][0]->email,  array('class'=>'form-control','placeholder' => 'Email','required' => 'required'))}}
        @if ($errors->has('member_email')) <p class="alert alert-danger">{{ $errors->first('member_email') }}</p> @endif
    </div>
</div>

<div class="form-group">	
    {{ Form::label('member_phone', 'Phone', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{Form::number('member_phone', $data['user'][0]->info,  array('class'=>'form-control','placeholder' => 'Phone','required' => 'required'))}}
        @if ($errors->has('member_phone')) <p class="alert alert-danger">{{ $errors->first('member_phone') }}</p> @endif
    </div>
</div>  

<div class="form-group">	
    {{ Form::label('club_id', 'Club', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{ Form::select('club_id', $data['clubs'],$data['user'][0]->club_id, array('id' => 'userClub_id', 'class'=>'form-control', 'multiple'=>'multiple', 'required'=>'required')); }}
        @if ($errors->has('club_id')) <p class="alert alert-danger">{{ $errors->first('club_id') }}</p> @endif
    </div>
</div>
{{ Form::hidden('edit_user_id', $data['user'][0]->id);}}
<div class="form-group">	
    {{ Form::label('user_type', 'Choose User Type', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10 radio-inline-inline">&nbsp;&nbsp;
        Admin User	 {{Form::radio('user_type', '2', false, array('class' => 'name'))}} &nbsp;&nbsp;&nbsp;&nbsp;
        PA	 {{Form::radio('user_type', '7', false, array('class' => 'name'))}}&nbsp;&nbsp;&nbsp;&nbsp;
        <!--        Medical Doctor	 {{Form::radio('user_type', '3', false, array('class' => 'name'))}}&nbsp;&nbsp;&nbsp;&nbsp;
                Fitness Coach	 {{Form::radio('user_type', '4', false, array('class' => 'name'))}}&nbsp;&nbsp;&nbsp;&nbsp;
                Wellness Experts {{Form::radio('user_type', '5', false, array('class' => 'name'))}}&nbsp;&nbsp;&nbsp;&nbsp;-->

    </div>
</div>
<div id="accessShowDiv"></div>




