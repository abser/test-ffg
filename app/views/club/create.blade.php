@extends("layouts.admin")
@section("content")
<div class="row-fluid">
<div class="col-md-6 col-xs-12">

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Club</h3>
    </div>
    <div class="panel-body">
    	{{ Form::open(array('url' => 'club', 'data-abide', 'class'=>'form-horizontal', 'id' => 'clubForm')) }}
        	@include('club._form')
        {{ Form::close() }}
    </div>
</div>

</div>
</div>	
@stop

@section('js')
{{ HTML::script('/assets/js/club.form.js') }}
@stop