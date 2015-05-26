<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_categories', function($table){
			$table->increments	('id');
			$table->string		('name', 100);
			$table->integer		('parent_id')	->unsigned()->nullable();
				
			$table->integer		('created_by')	->unsigned();
			$table->integer		('updated_by')	->unsigned()->nullable();
			$table->timestamps	();
			// $table->timestamp('deleted_at')->nullable();
			// $table->datetime('deleted_at')->nullable();
			// $table->nullableTimestamps();
			$table->softDeletes();
				
			$table->foreign('parent_id')->references('id')->on('service_categories');
				
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
		Schema::drop('service_categories');
	}

}
