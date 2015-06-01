@extends("layouts.admin")

@section('css')
{{ HTML::style('/assets/css/bootstrap-multiselect.css') }}
{{ HTML::style('/assets/css/directoryTree.css') }}
@stop

@section("content")
<div class="row-fluid">
<div class="col-md-6 col-xs-12">

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Update Room</h3>
    </div>
    <div class="panel-body">
    	{{ Form::model($data['room'], array('route' => array('room.update', $data['room']->id), 'method' => 'PUT', 'data-abide', 'class'=>'form-horizontal', 'id' => 'serviceForm')) }}
			@include('room._form', $data)
		{{ Form::close() }}
    </div>
</div>

</div>
</div>	
@stop

@section('js')
{{ HTML::script('/assets/js/bootstrap-multiselect.js') }}
{{ HTML::script('/assets/js/directoryTree.js') }}
{{ HTML::script('/assets/js/room.form.js') }}
@stop