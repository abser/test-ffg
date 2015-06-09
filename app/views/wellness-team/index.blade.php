@extends("layouts.admin")
@section("content")

<div class="row-fluid">
<div class="col-md-12 col-xs-12">

<h3>Wellness Team ({{ $data['model']->getTotal() }})</h3>
<div style="padding-bottom: .5em;"><a href="{{ URL::route($data['r_prefix'].'.create') }}" class="btn btn-default btn-raised">Add New Expert</a></div>

<div>
	<table class="table table-hover">
	<thead style="background-color: grey;">
		<tr>
			<th>{{link_to_route($data['route'], 'ID', array_merge($data['append_url'], ['sort' => 'id']))}}</th>
			<th>{{link_to_route($data['route'], 'First Name', array_merge($data['append_url'], ['sort' => 'first_name']))}}</th>
			<th>{{link_to_route($data['route'], 'Last Name', array_merge($data['append_url'], ['sort' => 'last_name']))}}</th>
			<th>{{link_to_route($data['route'], 'Email', array_merge($data['append_url'], ['sort' => 'email']))}}</th>			
		    <th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data['model'] as $key => $row)
		<tr>
			<td>{{ $row->id}}</td>
			<td>
				<strong>
					<a href="{{ URL::route('wellness-team.edit', $row->id) }}">
						<span class="{{(Input::get('sort' ) == 'first_name')? 'sprim-sort' : '' }}">{{ucfirst($row->first_name)}}</span>
					</a>
				</strong>
			</td>
			<td>
				<strong>
					<span class="{{(Input::get('sort' ) == 'last_name')? 'sprim-sort' : '' }}">{{ucfirst($row->last_name)}}</span>
				</strong>
			</td>
			<td>
				<span class="{{(Input::get('sort' ) == 'email')? 'sprim-sort' : '' }}">{{ucfirst($row->email)}}</span>
			</td>
			<td>
				<ul class="list-inline">
					<li><a href="{{ URL::route('wellness-team.edit', $row->id) }}"><i class="fi-pencil">Edit</i></a></li>
					
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