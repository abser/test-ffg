@extends("layouts.admin")
@section("content")

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Expert</h3>
    </div>
    <div class="panel-body">
    	{{ Form::open(array('url' => 'wellness-team', 'files'=> true, 'data-abide', 'class'=>'form-horizontal', 'id' => 'wellnessTeamForm')) }}
        	@include('wellness-team._form', $data)
        {{ Form::close() }}
    </div>
</div>

@stop

@section('js')
<script type="text/javascript">
    var region_id = {{ $data['user']->address->region_id or 0 }};
    var url_api_regions = "{{ url('api/regions/')}}";    
</script>

{{ HTML::script('/assets/js/wellness-team.form.js') }}
@stop