<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfileContacts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('profile_contacts', function(Blueprint $table) {
            $table->increments		('id');
            $table->integer			('user_id')			->unsigned()->nullable();
            $table->tinyInteger	    ('type')			->nullable();
            $table->integer			('profile_id')		->unsigned()->nullable();
            $table->enum			('contact_type', array('1', '2', '3'))->default(1);
            $table->enum			('is_private', array('0', '1'))->default(0);
            $table->string			('info');
            
            $table->integer			('created_by')		->unsigned();
            $table->integer			('updated_by')		->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
                      
            $table->foreign('profile_id')
            ->references('id')->on('profiles')
            ->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('profile_contacts');
    }

}
