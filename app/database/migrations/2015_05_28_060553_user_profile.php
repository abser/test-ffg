<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserProfile extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_profile', function($table) {
            $table->increments	('id');
            $table->integer     ('user_id')             ->unsigned()->nullable();
            $table->string      ('title', 50)			->nullable();
            $table->string      ('first_name', 100);
            $table->string      ('last_name', 100)      ->nullable();
            $table->integer     ('address_id')          ->unsigned()->nullable();
            $table->date        ('birth_date')          ->nullable();

            $table->string('profile_image');
            $table->string('profile_qualifications');
            $table->string('profile_description');          
            $table->string('gender');
            $table->string('occupation');
            $table->string('age_group');
            $table->string('interest_hobbies');
            
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
    public function down() {
        Schema::drop('user_profile');
    }

}
