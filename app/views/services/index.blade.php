@extends("layouts.admin")
@section("content")

<div class="row">
<div class="small-8 columns">
	<table>
	<thead>
		<th>Service Name</th>
		<th>Service Type</th>
		<th>Action</th>
	</thead>
	<tbody>
	
	
	</tbody>
	</table>
</div>
<div class="small-4 columns">
	@include('services._form')
</div>
</div>

@stop