<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('media_id');
			$table->integer('parent_id')->nullable();
			$table->string('title');
			$table->string('slug');
			$table->text('description');
			$table->string('type');
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
