<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_rooms', function(Blueprint $table)
		{
            $table->increments('_id');


            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('friend_id')->unsigned();
            $table->foreign('friend_id')->references('_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');

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
		Schema::table('chat_rooms');
	}

}
