<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_friends', function(Blueprint $table)
		{
            $table->increments('_id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('_id')->on('users');
            $table->integer('friend_id');
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
		Schema::drop('user_friends');
	}

}
