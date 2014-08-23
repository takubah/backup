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
			$table->integer('parent_id');
			$table->string('status');
			$table->string('type');
			$table->string('structure');
			$table->integer('order');
			$table->boolean('is_locked');
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->text('content_structure');
			$table->text('side_left');
			$table->text('side_right');
			$table->text('footer');
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
