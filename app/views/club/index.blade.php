@extends("layouts.admin")
@section("content")

<div class="row-fluid">
<div class="col-md-7 col-xs-12">

<h3>Clubs ({{ $data['model']->getTotal() }})</h3>
<div><a href="{{ URL::route($data['r_prefix'].'.create') }}" class="btn btn-default btn-raised">Add New Club</a></div>
	
</div>	
<div class="col-md-5 col-xs-12">

	

</div>
</div>

@stop