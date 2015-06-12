<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table){
				
			$table->integer		('created_by')	->unsigned();
			$table->integer		('updated_by')	->unsigned()->nullable();						
			$table->softDeletes();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			// $table->dropColumn('created_by');
			$table->dropColumn(array('created_by', 'updated_by', 'deleted_at'));
		});
	}

}
