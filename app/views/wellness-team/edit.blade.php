@extends("layouts.admin")
@section("content")

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Expert</h3>
    </div>
    <div class="panel-body">
    	{{ Form::model($data['user'], array('route' => array('wellness-team.update', $data['user']->id), 'method' => 'PUT', 'files'=> true, 'data-abide', 'class'=>'form-horizontal', 'id' => 'wellnessTeamForm')) }}
			@include('wellness-team._form', array('form'=>$data))
		{{ Form::close() }}
    </div>
</div>

@stop

@section('js')
{{ HTML::script('/assets/js/vendor/tinymce.min.js') }}
<script type="text/javascript">
    var region_id = {{ $data['user']->address->region_id or 0 }};
    var url_api_regions = "{{ url('api/regions/')}}";   
</script>
<!-- {{ HTML::script('/assets/js/bootstrap-multiselect.js') }} -->
{{ HTML::script('/assets/js/directoryTree.js') }}
{{ HTML::script('/assets/js/wellness-team.form.js') }}
@stop