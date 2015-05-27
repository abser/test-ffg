@extends("layouts.admin")
@section("content")

<div class="row-fluid">
<div class="col-md-6 col-xs-12">

<h3>Clubs ({{ $data['model']->getTotal() }})</h3>
<div><a href="{{ URL::route($data['r_prefix'].'.create') }}" class="btn btn-default btn-raised">Add New Club</a></div>

<div>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>{{link_to_route($data['route'], 'ID', array_merge($data['append_url'], ['sort' => 'id']))}}</th>
			<th>{{link_to_route($data['route'], 'Name', array_merge($data['append_url'], ['sort' => 'name']))}}</th>
			<th>{{link_to_route($data['route'], 'Country', array_merge($data['append_url'], ['sort' => 'country']))}}</th>			
		    <th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data['model'] as $key => $row)
		<tr>
			<td>{{ $row->id}}</td>
			<td>
				<strong>
					<a href="{{ URL::route('club.edit', $row->id) }}">
						<span class="{{(Input::get('sort' ) == 'name')? 'sprim-sort' : '' }}">{{ucfirst($row->name)}}</span>
					</a>
				</strong>
			</td>
			<td>
				@if( property_exists($row, 'country'))
					<span class="{{(Input::get('sort' ) == 'country')? 'sprim-sort' : '' }}">{{ ucfirst($row->country) }}</span>
				@endif
			</td>
			<td>
				<ul class="list-inline">
					<li><a href="{{ URL::route('club.edit', $row->id) }}"><i class="fi-pencil">Edit</i></a></li>
					<li>@if($row->status == 1)
							<a href="{{ URL::to('club/deactivate/'. $row->id) }}"><i>Deactivate</i></a>
						@else
							<a href="{{ URL::to('club/activate/'. $row->id) }}"><i>Activate</i></a>
						@endif
					</li>
				</ul>
			</td>
		</tr>
		@endforeach	
	</tbody>
</table>
</div>
	
</div>	
<div class="col-md-6 col-xs-12">

	

</div>
</div>

@stop