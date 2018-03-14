<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBletherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('blethers', function(Blueprint $table)
        {
            $table->increments('_id'); //blether id
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('_id')->on('users');
            $table->boolean('isLocked'); //is locked (by admin or user)
            $table->integer('permission_id'); //public / private
            $table->boolean('isActive'); //blether active
            $table->boolean('hasImage'); //has Image
            $table->boolean('isQuestion'); //blether is a question
            $table->string('subject');
            $table->string('image');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('blethers');
	}

}
