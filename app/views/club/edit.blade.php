@extends("layouts.admin")
@section("content")

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Update Club</h3>
    </div>
    <div class="panel-body">
    	{{ Form::model($data['club'], array('route' => array('club.update', $data['club']->id), 'method' => 'PUT', 'data-abide', 'class'=>'form-horizontal', 'id' => 'clubForm')) }}
			@include('club._form')
		{{ Form::close() }}
    </div>
</div>

@stop

@section('js')
<script type="text/javascript">
    var region_id = {{ $data['club']->address->region_id or 0 }};
    var url_api_regions = "{{ url('api/regions/')}}";    
</script>

{{ HTML::script('/assets/js/club.form.js') }}
@stop