@extends("layouts.admin")
@section("content")

<div class="row">
<div class="small-8 columns">
	<table>
	<thead>
		<th>Club Name</th>		
		<th>Action</th>
	</thead>
	<tbody>
	
	
	</tbody>
	</table>
</div>
<div class="small-4 columns">
	@include('clubs._form')
</div>
</div>

@stop