<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('comments', function(Blueprint $table)
        {
            $table->increments('_id'); //comment id
            $table->integer('blether_id')->unsigned()->index();
            $table->foreign('blether_id')->references('_id')->on('blethers');
            $table->integer('parent_id');
            $table->integer('user_id')->unsigned()->index(); //created by this user
            $table->foreign('user_id')->references('_id')->on('users');
            $table->string('content');
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
        Schema::drop('comments');
	}

}
