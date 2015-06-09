@extends("layouts.admin")
@section("content")

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Service</h3>
    </div>
    <div class="panel-body">
    	{{ Form::open(array('url' => 'service', 'data-abide', 'class'=>'form-horizontal', 'id' => 'serviceForm')) }}
        	@include('service._form', $data)
        {{ Form::close() }}
    </div>
</div>
	
@stop

@section('js')
<script type="text/javascript">
    var service_sub_category_id = {{ $data['service']->service_sub_category_id or 0 }};
    var url_api_services_sub_category = "{{ url('api/services_sub_category/')}}";    
</script>
{{ HTML::script('/assets/js/service.form.js') }}
@stop