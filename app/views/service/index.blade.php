@extends("layouts.admin")
@section("content")

<div class="box-header with-border">
	<h3 class="box-title">Services ({{ $data['model']->getTotal() }})</h3>
</div>
<div style="padding-bottom: .5em;"><a href="{{ URL::route($data['r_prefix'].'.create') }}" class="btn btn-default btn-raised">Add New Service</a></div>

<div>
	<table class="table table-hover">
	<thead style="background-color: grey;">
		<tr>
			<th>{{link_to_route($data['route'], 'ID', array_merge($data['append_url'], ['sort' => 'id']))}}</th>
			<th>{{link_to_route($data['route'], 'Service Name', array_merge($data['append_url'], ['sort' => 'name']))}}</th>
			<th>{{link_to_route($data['route'], 'Service Category', array_merge($data['append_url'], ['sort' => 'service_category']))}}</th>	
			<th>{{link_to_route($data['route'], 'Club Name', array_merge($data['append_url'], ['sort' => 'club_name']))}}</th>		
		    <th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data['model'] as $key => $row)
		<tr>
			<td>{{ $row->id}}</td>
			<td>
				<strong>
					<a href="{{ URL::route('service.edit', $row->id) }}">
						<span class="{{(Input::get('sort' ) == 'name')? 'sprim-sort' : '' }}">{{ucfirst($row->name)}}</span>
					</a>
				</strong>
			</td>
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
				<span class="{{(Input::get('sort' ) == 'club_name')? 'sprim-sort' : '' }}">{{ucfirst($row->club_name)}}</span>
			</td>
			<td>
				<ul class="list-inline">
					<li><a href="{{ URL::route('service.edit', $row->id) }}"><i class="fi-pencil">Edit</i></a></li>
					<li>@if($row->status == 1)
							<a href="{{ URL::to('service/deactivate/'. $row->id) }}"><i>Deactivate</i></a>
						@else
							<a href="{{ URL::to('service/activate/'. $row->id) }}"><i>Activate</i></a>
						@endif
					</li>
				</ul>
			</td>
		</tr>
		@endforeach	
	</tbody>
</table>
</div>

@stop