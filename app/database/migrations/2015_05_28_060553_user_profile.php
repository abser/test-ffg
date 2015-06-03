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
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('address_id')->unsigned();
            $table->string('profile_image');
            $table->string('profile_qualifications');
            $table->string('profile_description');
            $table->string('accept_appointment');
            $table->enum('change_default_password', array('0', '1'))->default(0);
            $table->string('gender');
            $table->string('occupation');
            $table->string('age_group');
            $table->string('interest_hobbies');
            $table->enum('display_profile_pic', array('0', '1'))->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
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
