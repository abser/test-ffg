<?php

class SentryGroupSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('groups')->delete();

        Sentry::getGroupProvider()->create([
            'name' => 'sprim',
            'permissions' => []]);

        Sentry::getGroupProvider()->create([
            'name' => 'admin',
            'permissions' => [
                'list_club' => '1',
                'create_club' => '1',
                'active_deactive_club' => '1',
                'delete_club' => '1',
                'list_user' => '1',
                'create_user' => '1',
                'active_deactive_user' => '1',
                'delete_user' => '1',
                'list_member' => '1',
                'create_member' => '1',
                'activate_deactivate_member' => '1',
                'delete_member' => '1',
                'message_to_member' => '1',
                'member_calender' => '1',
                'health_indexes' => '1',
                'sleep_indexes' => '1',
                'medial_indexes' => '1',
                'nutrition_indexes' => '1',
                'exercise_indexes' => '1',
                'other_indexes' => '1',
                'list_profiles' => '1',
                'create_profiles' => '1',
                'activate_deactivate_profile' => '1',
                'delete_profile' => '1',
                'profile_Calender_setup' => '1',
                'profile_calender_view' => '1',
                'export_profile' => '1',
                'list_group' => '1',
                'create_group' => '1',
                'published_unpublished_group' => '1',
                'delete_group' => '1',
                'list_events' => '1',
                'create_events' => '1',
                'published_unpublished_events' => '1',
                'delete_events' => '1',
                'list_rooms' => '1',
                'create_rooms' => '1',
                'activate_deactivate_rooms' => '1',
                'delete_rooms' => '1',
                'list_all_appointments' => '1',
                'create_appointments' => '1',
                'amend_appointments' => '1',
                'change_appointment_status' => '1',
                'export_appointments' => '1',
        ]]);

        Sentry::getGroupProvider()->create([
            'name' => 'medical_doctor',
            'permissions' => [
            	'list_member'				=> '1',
            	'create_member'				=> '1',
            	'activate_deactivate_member'=> '1',
            	'delete_member'				=> '1',
            	'message_to_member'			=> '1',
            	'member_calender'			=> '1',
            		
            	'list_all_appointments'		=> '1',
            	'create_appointments'		=> '1',
            	'amend_appointments'		=> '1',
            	'change_appointment_status' => '1',
            	'export_appointments'		=> '1',
            ]]);

        Sentry::getGroupProvider()->create([
            'name' => 'fitness_coach',
            'permissions' => [
            	'list_member'				=> '1',
            	'create_member'				=> '1',
            	'activate_deactivate_member'=> '1',
            	'delete_member'				=> '1',
            	'message_to_member'			=> '1',
            	'member_calender'			=> '1',
            		
            	'list_all_appointments'		=> '1',
            	'create_appointments'		=> '1',
            	'amend_appointments'		=> '1',
            	'change_appointment_status' => '1',
            	'export_appointments'		=> '1',
            ]]);

        Sentry::getGroupProvider()->create([
            'name' => 'wellness_expert',
            'permissions' => [
            	'list_member'				=> '1',
            	'create_member'				=> '1',
           		'activate_deactivate_member'=> '1',
           		'delete_member'				=> '1',
           		'message_to_member'			=> '1',
           		'member_calender'			=> '1',
           		
          		'list_all_appointments'		=> '1',
           		'create_appointments'		=> '1',
           		'amend_appointments'		=> '1',
           		'change_appointment_status' => '1',
           		'export_appointments'		=> '1',
            ]]);

        Sentry::getGroupProvider()->create([
            'name' => 'member',
            'permissions' => []]);

        Sentry::getGroupProvider()->create([
            'name' => 'pa',
            'permissions' => [
                'view_all_appointment' => '1',
                'calender_appointment' => '1',
                'create_appointment' => '1',
                'cancel_appointment' => '1',
                'view_all_group' => '1',
                'join_group' => '1',
                'unjoin_group' => '1',
                'leave_group' => '1',
                'view_all_event' => '1',
                'join_event' => '1',
                'unjoin_event' => '1',
                'list_all_ghcp' => '1',
                'view_all_ghcp' => '1',
                'ghcp_appointment' => '1'
        ]]);
    }

}