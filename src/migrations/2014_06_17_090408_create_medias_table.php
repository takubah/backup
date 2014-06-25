<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('medias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->string('type');
			$table->string('file');
			$table->string('mime_type');
			$table->integer('size');
			$table->string('title');
			$table->string('slug');
			$table->string('description');
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
		Schema::drop('medias');
	}

}
