@extends("layouts.admin")
@section("content")
<div class="row-fluid">
<div class="col-md-6 col-xs-12">

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Expert</h3>
    </div>
    <div class="panel-body">
    	{{ Form::model($data['user'], array('route' => array('wellness-team.update', $data['user']->id), 'method' => 'PUT', 'data-abide', 'class'=>'form-horizontal', 'id' => 'wellnessTeamForm')) }}
			@include('wellness-team._form', $data)
		{{ Form::close() }}
    </div>
</div>

</div>
</div>	
@stop

@section('js')
<script type="text/javascript">
    var region_id = {{ $data['user']->address->region_id or 0 }};
    var url_api_regions = "{{ url('api/regions/')}}";    
</script>

{{ HTML::script('/assets/js/club.form.js') }}
@stop