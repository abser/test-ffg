@extends("layouts.admin")
@section("content")

<div class="row-fluid">
    <div class="col-md-6 col-xs-12">

        <div><a href="member/create" class="btn btn-default btn-raised">Add New Member</a> &nbsp;&nbsp;<a href="member/messageBroadcast" class="btn btn-default btn-raised">Message Broadcast</a></div>

        <div>
            <table class="table table-hover">
                <thead>

                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Contact
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>		

                </thead>
                <tbody>
                    @foreach($data['memberData']  as $column => $field)
                    <tr>
                        <th>
                            {{$field['first_name'].$field['last_name']}}
                        </th>
                        <th>
                            {{$field['email']}}
                        </th>
                        <th>
                            {{$field['info']}}
                        </th>
                        <th>

                            @if ($field['activated'] == 1)
                            <a href="{{ URL::to('member/deactivate/'. $field['id']) }}"><i>Deactivate</i></a>
                            @else
                            <a href="{{ URL::to('member/activate/'. $field['id']) }}"><i>Activate</i></a>
                            @endif
                        </th>
                        <th>
                            <a href="#edit-club" class="club-edit" data-club_edit_id="<?php echo $field['id']; ?>" data-reveal-id="edit_club">
                                <i> H.index</i>
                            </a>

                        </th>
                        <th>
                            <a href="{{ URL::to('member/message/'. $field['id']) }}"><i>Message</i></a>

                        </th>
                        <th>
                            <a href="#edit-club" class="club-edit" data-club_edit_id="<?php echo $field['id']; ?>" data-reveal-id="edit_club">
                                <i> Appointment</i>
                            </a>

                        </th>

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