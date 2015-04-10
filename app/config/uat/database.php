<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'sprim-db-sg.ccpwunlkbvtj.ap-southeast-1.rds.amazonaws.com',
			'database'  => 'gravity_uat',
			'username'  => 'Ytpt78',
			'password'  => 'Pw89&t96#',
			'charset'   => 'utf8',
			'collation' => 'utf8_general_ci',
			'prefix'    => '',
		),
        
        
        'mysql_sprim_dhs' => array(
			'driver'    => 'mysql',
			'host'      => 'sprim-db-sg.ccpwunlkbvtj.ap-southeast-1.rds.amazonaws.com',
			'database'  => 'sprim_dhs',
			'username'  => 'Ytpt78',
			'password'  => 'Pw89&t96#',
			'charset'   => 'utf8',
			'collation' => 'utf8_general_ci',
			'prefix'    => '',
		),

		'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'homestead',
			'username' => 'homestead',
			'password' => 'secret',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),

	),

);