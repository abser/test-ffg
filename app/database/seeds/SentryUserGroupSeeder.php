<?php

class SentryUserGroupSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users_groups')->delete();

        $sprimUser = Sentry::getUserProvider()->findByLogin('sprim@sprim.com');
        $adminUser = Sentry::getUserProvider()->findByLogin('admin@sprim.com');
        $ghcpUser = Sentry::getUserProvider()->findByLogin('ghcp@sprim.com');
        $memberUser = Sentry::getUserProvider()->findByLogin('member@sprim.com');
        $paUser = Sentry::getUserProvider()->findByLogin('pa@sprim.com');

        $sprimGroup = Sentry::getGroupProvider()->findByName('sprim');

        $adminGroup = Sentry::getGroupProvider()->findByName('admin');
        $wellnessTeamGroup = Sentry::getGroupProvider()->findByName('wellness_expert');
        $wellnessTeamGroup = Sentry::getGroupProvider()->findByName('medical_doctor');
        $wellnessTeamGroup = Sentry::getGroupProvider()->findByName('fitness_coach');
        $memberGroup = Sentry::getGroupProvider()->findByName('member');
        $paGroup = Sentry::getGroupProvider()->findByName('pa');

        // Assign the groups to the users
        $sprimUser->addGroup($sprimGroup);
        $adminUser->addGroup($adminGroup);
        $ghcpUser->addGroup($wellnessTeamGroup);
        $memberUser->addGroup($memberGroup);
        $paUser->addGroup($paGroup);
    }

}
