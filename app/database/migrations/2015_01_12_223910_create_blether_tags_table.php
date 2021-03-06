<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBletherTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blether_tags', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('blether_id')->unsigned()->default(0);
            $table->integer('tag_id')->unsigned()->default(0);
            $table->foreign('blether_id')->references('_id')->on('blethers')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
		Schema::table('blether_tags', function(Blueprint $table)
		{
			//
		});
	}

}
