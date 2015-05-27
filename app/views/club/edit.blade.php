@extends("layouts.admin")
@section("content")

{{ Form::model($data['club'], array('route' => array('club.update', $data['club']->id), 'data-abide')) }}
		@include('club._form')
	{{ Form::close() }}
	
@stop