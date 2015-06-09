@extends("layouts.admin")
@section("content")

<div class="row-fluid">
    <div class="col-md-12 col-xs-12">

        <h3>Gravity users List ({{ $data['model']->getTotal() }})</h3>
        <div><a href="{{ URL::route('member.create') }}" class="btn btn-default btn-raised">Add New Member</a></div>

        <div>
            <table class="table table-hover">
                <thead style="background-color: grey;">
                    <tr>
                        <th>{{link_to_route($data['route'], 'ID', array_merge($data['append_url'], ['sort' => 'id']))}}</th>
                        <th>{{link_to_route($data['route'], 'Name', array_merge($data['append_url'], ['sort' => 'first_name']))}}</th>
                        <th>{{link_to_route($data['route'], 'Email', array_merge($data['append_url'], ['sort' => 'email']))}}</th>
                        <th>{{link_to_route($data['route'], 'Contact', array_merge($data['append_url'], ['sort' => 'info']))}}</th>			
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['model'] as $key => $row)
                    <tr>
                        <td>{{ $row->id}}</td>
                        <td>
                            <strong>
                                <a href="{{ URL::route('user.edit', $row->id) }}">
                                    <span class="{{(Input::get('sort' ) == 'first_name')? 'sprim-sort' : '' }}">{{ucfirst($row->first_name)}}</span>
                                </a>
                            </strong>
                        </td>
                        <td>{{ $row->email}}</td>
                        <td>
                           
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ URL::route('member.edit', $row->id) }}"><i class="fi-pencil">Edit</i></a></li>
                                <li>
                                    @if ($row->activated == 1)
                                    <a href="{{ URL::to('user/userdeactivate/'. $row->id,"member") }}"><i>Deactivate</i></a>
                                    @else
                                    <a href="{{ URL::to('user/useractivate/'. $row->id,"member") }}"><i>Activate</i></a>
                                    @endif
                                </li>
                                
                                  <li>
                                    <a href="#edit-club" class="club-edit" data-club_edit_id="<?php echo $row->id; ?>" data-reveal-id="edit_club">
                                <i> H.index</i>
                            </a>
                                </li>
                                
                                  <li>
                                     <a href="{{ URL::to('member/message/'. $row->id) }}"><i>Message</i></a>
                                </li>
                                
                                 <li>
                                     <a href="#edit-club" class="club-edit" data-club_edit_id="<?php echo $row->id; ?>" data-reveal-id="edit_club">
                                <i> Appointment</i>
                            </a>

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