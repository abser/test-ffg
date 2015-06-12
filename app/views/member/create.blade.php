@extends("layouts.admin")
@section("content")
<div class="row-fluid">
<div class="col-md-10 col-xs-12">

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Member</h3>
    </div>
    <div class="panel-body">
    	            	{{ Form::open(array('url' => 'member', 'data-abide', 'class'=>'form-horizontal', 'id' => 'memberForm','files'=>true)) }}

        	@include('member._form')
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