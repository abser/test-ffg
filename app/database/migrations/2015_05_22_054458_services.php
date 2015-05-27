<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Services extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function($table){
			$table->increments	('id');
			$table->integer		('club_id')					->unsigned();
			$table->string		('name', 100);
			$table->integer		('service_category_id')		->unsigned();
			$table->integer		('service_sub_category_id')	->unsigned();
			$table->text		('description')				->nullable();
			$table->text		('cancellation_notes')		->nullable();
			$table->float		('cancellation_notice_period')	->nullable();
			$table->tinyInteger	('ghcp_appointment')		->default(0);
			$table->tinyInteger	('only_ghcp')				->default(0);
			$table->enum		('status', array('0', '1'))	->default(0);
			
			$table->integer		('created_by')				->unsigned();
			$table->integer		('updated_by')				->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
				
			$table->foreign		('club_id')					->references('id')->on('clubs');
			$table->foreign		('service_category_id')		->references('id')->on('service_categories');
			$table->foreign		('service_sub_category_id')	->references('id')->on('service_categories');
				
			$table->unique('name');
			$table->index('club_id');
			$table->index('service_category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('services');
	}

}
