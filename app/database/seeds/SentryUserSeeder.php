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
	        'email'    => 'admin@sprim.com',
	        'password' => 'Admin@sprim123',
	        'activated' => 1,
	    ));

	    Sentry::getUserProvider()->create(array(
	        'email'    => 'user@sprim.com',
	        'password' => 'User@sprim123',
	        'activated' => 1,
	    ));
        
        Sentry::getUserProvider()->create(array(
	        'email'    => 'test@sprim.com',
	        'password' => 'Test@sprim123',
	        'activated' => 1,
	    ));
        
	}

}