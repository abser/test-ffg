<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clubs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clubs', function($table){
			$table->increments	('id');
			$table->string		('name', 100);
			$table->integer		('address_id')		->unsigned();
			$table->text		('description')		->nullable();
			$table->enum		('status', array('0', '1'))->default(0);
		
			$table->integer		('created_by')				->unsigned();
			$table->integer		('updated_by')				->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->unique('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clubs');
	}

}
