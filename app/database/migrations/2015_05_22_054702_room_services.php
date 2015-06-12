<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomServices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_services', function($table) {
			$table->increments	('id');
			$table->integer		('room_id')		->unsigned();
			$table->integer		('service_id')	->unsigned();
			
			$table->integer		('created_by')	->unsigned();
			$table->integer		('updated_by')	->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->foreign('room_id')
					->references('id')->on('rooms')
					->onDelete('cascade');
			
			$table->foreign('service_id')
					->references('id')->on('services')
					->onDelete('cascade');				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('room_services');
	}

}
