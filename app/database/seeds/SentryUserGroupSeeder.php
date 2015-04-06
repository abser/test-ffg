<?php

class SentryUserGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users_groups')->delete();

		$userUser   = Sentry::getUserProvider()->findByLogin('user@sprim.com');
		$adminUser  = Sentry::getUserProvider()->findByLogin('admin@sprim.com');
        $testUser   = Sentry::getUserProvider()->findByLogin('test@sprim.com');

		$userGroup = Sentry::getGroupProvider()->findByName('member');
		$adminGroup = Sentry::getGroupProvider()->findByName('sprim');

	    // Assign the groups to the users
	    $userUser->addGroup($userGroup);
	    $adminUser->addGroup($adminGroup);
        $testUser->addGroup($adminGroup);
	}

}