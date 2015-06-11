<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rooms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function($table){
			$table->increments	('id');
			$table->integer		('club_id')				->unsigned()->nullable();
			$table->string		('name', 100);
			$table->integer		('room_number')			->unsigned()->nullable();
			$table->integer		('capacity')			->unsigned()->nullable();
			$table->enum		('is_conjunct', array('0', '1'))->default(0);
			$table->enum		('status', array('0', '1'))->default(0);
			
			$table->integer		('created_by')			->unsigned();
			$table->integer		('updated_by')			->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->foreign('club_id')
					->references('id')->on('clubs')
					->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rooms');
	}

}
