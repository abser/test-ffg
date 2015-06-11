<?php

class SentryUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		
		Sentry::getUserProvider()->create(array(
			'email'		=> 'sprim@sprim.com',
			'password'	=> 'Sprim@sprim123',
			'activated' => 1,
			'created_by'=> 1
		));
		
		Sentry::getUserProvider()->create(array(
			'email'		=> 'admin@sprim.com',
			'password'	=> 'Admin@sprim123',
			'activated' => 1,
			'created_by'=> 1
		));

		Sentry::getUserProvider()->create(array(
	        'email'		=> 'ghcp@sprim.com',
	        'password'	=> 'Admin@sprim123',
	        'activated' => 1,
			'created_by'=> 1
	    ));

	    Sentry::getUserProvider()->create(array(
	        'email'		=> 'member@sprim.com',
	        'password'	=> 'Member@sprim123',
	        'activated' => 1,
	    	'created_by'=> 1
	    ));
        
        Sentry::getUserProvider()->create(array(
	        'email'		=> 'pa@sprim.com',
	        'password'	=> 'Pa@sprim123',
	        'activated' => 1,
        	'created_by'=> 1
	    ));
	}

}