<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClubUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('club_users', function($table){
			$table->increments	('id');
			$table->integer		('club_id')					->unsigned();
			$table->integer		('user_id')					->unsigned();
			$table->tinyInteger	('type')					->unsigned();	//1=>Admin, 2=>Member, 3=>PA
			$table->enum		('status', array('0', '1'))->default(0);
		
			$table->integer		('created_by')				->unsigned();
			$table->integer		('updated_by')				->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->foreign		('club_id')					->references('id')->on('clubs');
			$table->foreign		('user_id')					->references('id')->on('users');
		
			$table->index('club_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('club_users');
	}

}
