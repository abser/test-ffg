<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicePrices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_prices', function($table){
			$table->increments	('id');
			$table->integer		('service_id')	->unsigned();
			$table->integer		('duration')	->unsigned()->nullable();
			$table->float		('price')		->unsigned()->nullable();
		
			$table->integer		('created_by')	->unsigned();
			$table->integer		('updated_by')	->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->foreign('service_id')->references('id')->on('services');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_prices');
	}

}
