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
        <h3 class="panel-title">Update Member</h3>
    </div>
    <div class="panel-body">
    	{{ Form::model($data['member'], array('route' => array('member.update',20), 'method' => 'PUT', 'data-abide', 'class'=>'form-horizontal', 'id' => 'serviceForm')) }}
			@include('member._form_edit', $data)
		{{ Form::close() }}
    </div>
</div>

</div>
</div>	
@stop

@section('js')
{{ HTML::script('/assets/js/club.form.js') }}
{{ HTML::script('/assets/js/bootstrap-multiselect.js') }}
{{ HTML::script('/assets/js/directoryTree.js') }}
{{ HTML::script('/assets/js/member.form.js') }}
<script type="text/javascript">
    var region_id = {{ $data['club']->address->region_id or 0 }};
    var url_api_regions = "{{ url('api/regions/')}}"; 
</script>

@stop