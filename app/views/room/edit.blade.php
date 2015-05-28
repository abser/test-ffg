@extends("layouts.admin")
@section("content")
<div class="row-fluid">
<div class="col-md-6 col-xs-12">

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Update Service</h3>
    </div>
    <div class="panel-body">
    	{{ Form::model($data['service'], array('route' => array('service.update', $data['service']->id), 'method' => 'PUT', 'data-abide', 'class'=>'form-horizontal', 'id' => 'serviceForm')) }}
			@include('service._form', $data)
		{{ Form::close() }}
    </div>
</div>

</div>
</div>	
@stop

@section('js')
{{ HTML::script('/assets/js/service.form.js') }}
@stop