<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addresses extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('addresses', function($table) {
            $table->increments('id');
            $table->string		('address1', 100)	->nullable();
            $table->string		('address2', 100)	->nullable();
            $table->string		('street', 100)		->nullable();
            $table->string		('city', 100)		->nullable();
            $table->integer		('region_id')		->unsigned()->nullable();
            $table->string		('country_code', 2)	->nullable();
            $table->string		('postal_code', 10)	->nullable();

            $table->integer		('created_by')		->unsigned();
            $table->integer		('updated_by')		->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('country_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('addresses');
    }

}
