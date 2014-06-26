<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			// $table->integer('objectable_id');
			// $table->string('objectable_type');
			$table->integer('parent_id');
			$table->string('status');
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->text('side_left');
			$table->text('side_right');
			$table->text('footer');
			$table->integer('order');
			$table->string('meta_title')->nullable();
			$table->text('meta_keyword')->nullable();
			$table->text('meta_description')->nullable();
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
		Schema::drop('pages');
	}

}
