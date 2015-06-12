<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomConjuncts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('room_conjuncts', function($table) {
			$table->increments	('id');
			$table->integer		('room_id')			->unsigned();
			$table->integer		('conjunct_room_id')->unsigned();
			
			$table->integer		('created_by')		->unsigned();
			$table->integer		('updated_by')		->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->foreign('room_id')
					->references('id')->on('rooms')
					->onDelete('cascade');
				
			$table->foreign('conjunct_room_id')
					->references('id')->on('rooms')
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
		Schema::drop('room_conjuncts');
	}

}
