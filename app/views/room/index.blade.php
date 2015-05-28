@extends("layouts.admin")
@section("content")

<div class="row-fluid">
<div class="col-md-6 col-xs-12">

<h3>Rooms ({{ $data['model']->getTotal() }})</h3>
<div><a href="{{ URL::route($data['r_prefix'].'.create') }}" class="btn btn-default btn-raised">Add New Room</a></div>

<div>
	<table class="table table-hover">
	<thead style="background-color: grey;">
		<tr>
			<th>{{link_to_route($data['route'], 'ID', array_merge($data['append_url'], ['sort' => 'id']))}}</th>
			<th>{{link_to_route($data['route'], 'Room Name', array_merge($data['append_url'], ['sort' => 'name']))}}</th>
			<th>{{link_to_route($data['route'], 'Room Number', array_merge($data['append_url'], ['sort' => 'room_number']))}}</th>
			<th>{{link_to_route($data['route'], 'Service', array_merge($data['append_url'], ['sort' => 'name']))}}</th>			
		    <th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data['model'] as $key => $row)
		<tr>
			<td>{{ $row->id}}</td>
			<td>
				<strong>
					<a href="{{ URL::route('room.edit', $row->id) }}">
						<span class="{{(Input::get('sort' ) == 'name')? 'sprim-sort' : '' }}">{{ucfirst($row->name)}}</span>
					</a>
				</strong>
			</td>
			<td>{{ $row->room_number}}</td>
			<td>
				@if( property_exists($row, 'service_category'))
					<span class="{{(Input::get('sort' ) == 'service_category')? 'sprim-sort' : '' }}">
						{{ ucfirst($row->service_category) }} 
						@if (property_exists($row, 'service_sub_category') && $row->service_sub_category)
							-> {{ ucfirst($row->service_sub_category) }} 
						@endif
					</span>
				@endif
			</td>
			<td>
				<ul class="list-inline">
					<li><a href="{{ URL::route('room.edit', $row->id) }}"><i class="fi-pencil">Edit</i></a></li>
					<li>@if($row->status == 1)
							<a href="{{ URL::to('room/deactivate/'. $row->id) }}"><i>Deactivate</i></a>
						@else
							<a href="{{ URL::to('room/activate/'. $row->id) }}"><i>Activate</i></a>
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