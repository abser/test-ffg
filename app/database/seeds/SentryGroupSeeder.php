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
			'name'        => 'ghcp',
			'permissions' => []]);
		
		Sentry::getGroupProvider()->create([
			'name'        => 'member',
			'permissions' => []]);
		
	}
}