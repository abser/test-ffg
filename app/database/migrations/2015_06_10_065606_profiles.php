<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Profiles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function($table){
			$table->increments	('id');
			$table->integer     ('user_id')             ->unsigned()->nullable();
			$table->string      ('title', 50)			->nullable();
			$table->string      ('first_name', 100);	
			$table->string      ('last_name', 100)      ->nullable();
			$table->integer     ('address_id')          ->unsigned()->nullable();
			$table->date        ('birth_date')          ->nullable();
			
			// $table->tinyInteger	('gender')			->nullable();	// NOT_KNOWN(0), MALE(1), FEMALE(2), NOT_APPLICABLE(9);   //ISO 5218
			// $table->char		('gender', 1)			->nullable();	// M,F,O
			$table->string		('gender', 10)			->nullable();	// M,F,O
			$table->string		('age_group', 10)		->nullable();			
			$table->string		('image', 100)			->nullable();
			$table->string		('qualification', 255)	->nullable();
			$table->string		('description', 255)	->nullable();
			$table->string		('occupation', 255)		->nullable();
			$table->string		('hobbies', 255)		->nullable();	// Interests/Hobbies
			
			$table->enum		('accept_appointment', array('0', '1'))		->default(1);	// 0=> Don't Accept, 1=>Accept
			$table->enum		('change_default_password', array('0', '1'))->default(1);	// 0=> No Change, 1=>Change 
			$table->enum		('display_profile_pic', array('0', '1'))	->default(1);	// 0=> No Display, 1=>Display	
				
			$table->integer		('created_by')		->unsigned();
			$table->integer		('updated_by')		->unsigned()->nullable();
			$table->timestamps	();
			$table->softDeletes();
		
			$table->foreign('address_id')
                ->references('id')->on('addresses')
                ->onDelete('set null');
            
            $table->foreign('user_id')
                ->references('id')->on('users')
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
		Schema::drop('profiles');
	}

}
