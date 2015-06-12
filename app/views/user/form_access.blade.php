<?php 
if($data['userDivType'] == 'adminUser')  {  ?>
<div id="admin_user_div">

    <div class="form-group">	
        {{ Form::label('user_type', 'Access Control', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                 {{ Form::checkbox('permission[adm_club_full_access]', '1',true,array('id' => 'adm_club_full_access'))}}
                Club Full Access</div>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_list_club]', '1',true,array('id' => 'adm_list_club'))}}
            List Clubs
               
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_create_club]', '1',true,array('id' => 'adm_create_club'))}}
               Create Club
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_active_deactive_club]', '1',true,array('id' => 'adm_active_deactive_club'))}}
               Activate/Deactivate Club
            </label>

            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_delete_club]', '1',true,array('id' => 'adm_delete_club'))}}
                 Delete Club
            </label>
        </div>
    </div>

    <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                   {{ Form::checkbox('permission[adm_user_full_access]', '1',true,array('id' => 'adm_user_full_access'))}}
                
                User Full Access</div>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_list_user]', '1',true,array('id' => 'adm_list_user'))}}
               List User
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_create_user]', '1',true,array('id' => 'adm_create_user'))}}
                Create User
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_active_deactive_user]', '1',true,array('id' => 'adm_active_deactive_user'))}}
                Activate/Deactivate User
            </label>

            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_delete_user]', '1',true,array('id' => 'adm_delete_user'))}}
              Delete User
            </label>
        </div>
    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                  {{ Form::checkbox('permission[adm_member_full_access]', '1',true,array('id' => 'adm_member_full_access'))}}
               Member Full Access</div>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_list_member]', '1',true,array('id' => 'adm_list_member'))}}
                List Members
            </label>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_create_member]', '1',true,array('id' => 'adm_create_member'))}}
                Create Member
            </label>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_activate_deactivate_member]', '1',true,array('id' => 'adm_activate_deactivate_member'))}}
              Activate/Deactivate Member
            </label>

            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_delete_member]', '1',true,array('id' => 'adm_delete_member'))}}
             Delete Member
            </label>
        </div>

        <div class="col-lg-10 radio-inline-inline">
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_message_to_member]', '1',true,array('id' => 'adm_message_to_member'))}}
               Message to Members
            </label>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_member_calender]', '1',true,array('id' => 'adm_member_calender'))}}
                Member Calender
            </label>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_health_indexes]', '1',true,array('id' => 'adm_health_indexes'))}}
               Health Indexes
            </label>

            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_sleep_indexes]', '1',true,array('id' => 'adm_sleep_indexes'))}}
                Sleep Indexes
            </label>
        </div>

        <div class="col-lg-10 radio-inline-inline">&nbsp;&nbsp;
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_medial_indexes]', '1',true,array('id' => 'adm_medial_indexes'))}}
               Medical Indexes
            </label>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_nutrition_indexes]', '1',true,array('id' => 'adm_nutrition_indexes'))}}
                Nutrition Indexes
            </label>
            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_exercise_indexes]', '1',true,array('id' => 'adm_exercise_indexes'))}}
               Exercise Indexes
            </label>

            <label class="checkbox-inline">
                  {{ Form::checkbox('permission[adm_other_indexes]', '1',true,array('id' => 'adm_other_indexes'))}}
                Other Indexes
            </label>
        </div>



    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                   {{ Form::checkbox('permission[adm_profile_full_access]', '1',true,array('id' => 'adm_profile_full_access'))}}
                Profiles Full Access</div>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_list_profiles]', '1',true,array('id' => 'adm_list_profiles'))}}
                List Profiles
            </label>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_create_profiles]', '1',true,array('id' => 'adm_create_profiles'))}}
                 Create Profiles
            </label>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_activate_deactivate_profile]', '1',true,array('id' => 'adm_activate_deactivate_profile'))}}
                Activate/Deactivate Profiles
            </label>

            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_delete_profile]', '1',true,array('id' => 'adm_delete_profile'))}}
               Delete Profiles
            </label>
        </div>

        <div class="col-lg-10 radio-inline-inline">&nbsp;&nbsp;
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_profile_Calender_setup]', '1',true,array('id' => 'adm_profile_Calender_setup'))}}
              Profile Calender Setup
            </label>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_profile_calender_view]', '1',true,array('id' => 'adm_profile_calender_view'))}}
               Profile Calender View
            </label>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_export_profile]', '1',true,array('id' => 'adm_export_profile'))}}
                Export Profiles
            </label>

        </div>
    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
              
            <div class="chekbox_heading">  {{ Form::checkbox('permission[adm_group_full_access]', '1',true,array('id' => 'adm_group_full_access'))}} Group Full Access</div>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_list_group]', '1',true,array('id' => 'adm_list_group'))}}
                 List Group
            </label>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_create_group]', '1',true,array('id' => 'adm_create_group'))}}
                 Create Group
            </label>
            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_published_unpublished_group]', '1',true,array('id' => 'adm_published_unpublished_group'))}}
                Published/Unpublished Group
            </label>

            <label class="checkbox-inline">
                   {{ Form::checkbox('permission[adm_delete_group]', '1',true,array('id' => 'adm_delete_group'))}}
               Delete Group
            </label>
        </div>

    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                 {{ Form::checkbox('permission[adm_event_full_access]', '1',true,array('id' => 'adm_event_full_access'))}}
                Event Full Access</div>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_list_events]', '1',true,array('id' => 'adm_list_events'))}}
               List Events
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_create_events]', '1',true,array('id' => 'adm_create_events'))}}
                Create Events
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_published_unpublished_events]', '1',true,array('id' => 'adm_published_unpublished_events'))}}
                Published/Unpublished Events
            </label>

            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_delete_events]', '1',true,array('id' => 'adm_delete_events'))}}
                Delete Events
            </label>
        </div>

    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                 {{ Form::checkbox('permission[adm_room_full_access]', '1',true,array('id' => 'adm_room_full_access'))}}
             Room Full Access</div>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_list_rooms]', '1',true,array('id' => 'adm_list_rooms'))}}
              List Rooms
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_create_rooms]', '1',true,array('id' => 'adm_create_rooms'))}}
                 Create Rooms
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_activate_deactivate_rooms]', '1',true,array('id' => 'adm_activate_deactivate_rooms'))}}
                Activate/Deactivate Rooms
            </label>

            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_delete_rooms]', '1',true,array('id' => 'adm_delete_rooms'))}}
                Delete Rooms
            </label>
        </div>

    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                 {{ Form::checkbox('permission[adm_appointment_full_access]', '1',true,array('id' => 'adm_appointment_full_access'))}}
                Appointment Full Access</div>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_list_all_appointments]', '1',true,array('id' => 'adm_list_all_appointments'))}}
                List All Appointments
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_create_appointments]', '1',true,array('id' => 'adm_create_appointments'))}}
                Create Appointments
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_amend_appointments]', '1',true,array('id' => 'adm_amend_appointments'))}}
                Amend Appointment
            </label>

        </div>

        <div class="col-lg-10 radio-inline-inline">&nbsp;&nbsp;
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_change_appointment_status]', '1',true,array('id' => 'adm_change_appointment_status'))}}
               Change Appointment Status(Confirm or Cancel)
            </label>
            <label class="checkbox-inline">
                 {{ Form::checkbox('permission[adm_export_appointments]', '1',true,array('id' => 'adm_export_appointments'))}}
                 Export Appointments
            </label>


        </div>
    </div> <br>
 {{Form::hidden('name','admin')}}
    <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <button type="submit" class="btn btn-default">Save Member</button>
            <a href="{{ URL::route('member.index') }}"><button type="button" class="btn">Cancel</button></a>
        </div>
    </div>

</div>  
<?php } else if($data['userDivType'] == 'paUser')  {  ?>
<div id="pa_user_div">
    <div class="form-group">	
        {{ Form::label('user_type', 'Control Access', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                {{ Form::checkbox('permission[pa_appt_full_access]', '1',true,array('id' => 'pa_appt_full_access'))}}
                Appointment Full Access</div>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_view_alpa_cancel_appointment]', '1',true,array('id' => 'pa_view_alpa_cancel_appointment'))}} View All Appointment

            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_calender_appointment]', '1',true,array('id' => 'pa_calender_appointment'))}} Calender Appointment

            </label>
            <label class="checkbox-inline">

                {{ Form::checkbox('permission[pa_create_appointment]', '1',true,array('id' => 'pa_create_appointment'))}}
                Create Appointment

            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_cancel_appointment]', '1',true,array('id' => 'pa_cancel_appointment'))}}
                Create Appointment
            </label>


        </div>


    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                {{ Form::checkbox('permission[pa_group_full_access]', '1',true,array('id' => 'pa_group_full_access'))}}
                Group Full Access</div>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_view_all_group]', '1',true,array('id' => 'pa_view_all_group'))}}
                Create Appointments
                View All Group
            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_join_group]', '1',true,array('id' => 'pa_join_group'))}}
                Join Group
            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_leave_group]', '1',true,array('id' => 'pa_leave_group'))}}
                Leave Group
            </label>

        </div>

    </div> <br>

    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                {{ Form::checkbox('permission[pa_event_full_access]', '1',true,array('id' => 'pa_event_full_access'))}}
                Event Full Access</div>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_view_all_event]', '1',true,array('id' => 'pa_view_all_event'))}}
                View All Events
            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_join_event]', '1',true,array('id' => 'pa_join_event'))}}
                Join Events
            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_unjoin_event]', '1',true,array('id' => 'pa_unjoin_event'))}}
                unJoin Event
            </label>
        </div>

    </div> <br>
    <div class="form-group">	
        {{ Form::label('', '', array('class' => 'col-lg-2 control-label')) }}
        <div class="col-lg-10 radio-inline-inline">
            <div class="chekbox_heading">
                {{ Form::checkbox('permission[pa_ghcp_full_access]', '1',true,array('id' => 'pa_ghcp_full_access'))}}
                GHCP Full Access</div>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_list_all_ghcp]', '1',true,array('id' => 'pa_list_all_ghcp'))}}
                List All GHCP
            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_view_all_ghcp]', '1',true,array('id' => 'pa_view_all_ghcp'))}}
                View All GHCP
            </label>
            <label class="checkbox-inline">
                {{ Form::checkbox('permission[pa_ghcp_appointment]', '1',true,array('id' => 'pa_ghcp_appointment'))}}
                GHCP Appointment 
            </label>

        </div>
    </div> <br>
     {{Form::hidden('name','pa')}}

    <div class="form-group">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <button type="submit" class="btn btn-default">Save Member</button>
            <a href="{{ URL::route('member.index') }}"><button type="button" class="btn">Cancel</button></a>
        </div>
    </div>

</div>
<?php } ?>


