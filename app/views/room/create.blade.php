@extends("layouts.admin")
@section('css')
{{ HTML::style('/assets/css/bootstrap-multiselect.css') }}
{{ HTML::style('/assets/css/directoryTree.css') }}
@stop

@section("content")

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Room</h3>
    </div>
    <div class="panel-body">
    	{{ Form::open(array('url' => 'room', 'data-abide', 'class'=>'form-horizontal', 'id' => 'roomForm')) }}
        	@include('room._form', $data)
        {{ Form::close() }}
    </div>
</div>

@stop

@section('js')
{{ HTML::script('/assets/js/bootstrap-multiselect.js') }}
{{ HTML::script('/assets/js/directoryTree.js') }}
{{ HTML::script('/assets/js/room.form.js') }}
@stop