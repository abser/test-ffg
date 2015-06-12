<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileOwners extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file_owners', function($table)
		{
			$table->integer     ('file_id') ->unsigned();;
			$table->integer     ('owner_id')->unsigned();;
			$table->integer     ('owner_table');
		
			$table->foreign('file_id')
			->references('id')->on('files')
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
		Schema::drop('file_owners');
	}

}
