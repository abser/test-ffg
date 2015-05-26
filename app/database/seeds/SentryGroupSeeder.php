<?php

class SentryGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('groups')->delete();

		Sentry::getGroupProvider()->create([
	        'name'        => 'sprim',
	        'permissions' => []]);
		
		Sentry::getGroupProvider()->create([
			'name'        => 'admin',
			'permissions' => []]);
		
		Sentry::getGroupProvider()->create([
			'name'        => 'wellness_team',
			'permissions' => []]);
		
		Sentry::getGroupProvider()->create([
			'name'        => 'member',
			'permissions' => []]);
		
		Sentry::getGroupProvider()->create([
				'name'        => 'pa',
				'permissions' => []]);
		
	}
}