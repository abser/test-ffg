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
                'adm_list_club' => '1',
                'adm_create_club' => '1',
                'adm_active_deactive_club' => '1',
                'adm_delete_club' => '1',
                'adm_list_user' => '1',
                'adm_create_user' => '1',
                'adm_active_deactive_user' => '1',
                'adm_delete_user' => '1',
                'adm_list_member' => '1',
                'adm_create_member' => '1',
                'adm_activate_deactivate_member' => '1',
                'adm_delete_member' => '1',
                'adm_message_to_member' => '1',
                'adm_member_calender' => '1',
                'adm_health_indexes' => '1',
                'adm_sleep_indexes' => '1',
                'adm_medial_indexes' => '1',
                'adm_nutrition_indexes' => '1',
                'adm_exercise_indexes' => '1',
                'adm_other_indexes' => '1',
                'adm_list_profiles' => '1',
                'adm_create_profiles' => '1',
                'adm_activate_deactivate_profile' => '1',
                'adm_delete_profile' => '1',
                'adm_profile_Calender_setup' => '1',
                'adm_profile_calender_view' => '1',
                'adm_export_profile' => '1',
                'adm_list_group' => '1',
                'adm_create_group' => '1',
                'adm_published_unpublished_group' => '1',
                'adm_delete_group' => '1',
                'adm_list_events' => '1',
                'adm_create_events' => '1',
                'adm_published_unpublished_events' => '1',
                'adm_delete_events' => '1',
                'adm_list_rooms' => '1',
                'adm_create_rooms' => '1',
                'adm_activate_deactivate_rooms' => '1',
                'adm_delete_rooms' => '1',
                'adm_list_all_appointments' => '1',
                'adm_create_appointments' => '1',
                'adm_amend_appointments' => '1',
                'adm_change_appointment_status' => '1',
                'adm_export_appointments' => '1',
        ]]);

        Sentry::getGroupProvider()->create([
            'name' => 'medical_doctor',
            'permissions' => []]);

        Sentry::getGroupProvider()->create([
            'name' => 'fitness_coach',
            'permissions' => []]);

        Sentry::getGroupProvider()->create([
            'name' => 'wellness_expert',
            'permissions' => []]);

        Sentry::getGroupProvider()->create([
            'name' => 'member',
            'permissions' => []]);

        Sentry::getGroupProvider()->create([
            'name' => 'pa',
            'permissions' => [
                'pa_view_all_appointment' => '1',
                'pa_calender_appointment' => '1',
                'pa_create_appointment' => '1',
                'pa_cancel_appointment' => '1',
                'pa_view_all_group' => '1',
                'pa_join_group' => '1',
                'pa_unjoin_group' => '1',
                'pa_leave_group' => '1',
                'pa_view_all_event' => '1',
                'pa_join_event' => '1',
                'pa_unjoin_event' => '1',
                'pa_list_all_ghcp' => '1',
                'pa_view_all_ghcp' => '1',
                'pa_ghcp_appointment' => '1'
        ]]);
    }

}
