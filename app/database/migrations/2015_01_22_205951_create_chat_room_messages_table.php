<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_room_messages', function(Blueprint $table)
		{
            $table->increments('_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('chat_id')->unsigned();
            $table->foreign('chat_id')->references('_id')->on('chat_rooms');
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
		Schema::drop('chat_room_messages');
	}

}
