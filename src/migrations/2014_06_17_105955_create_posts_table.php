<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('groupable_id');
		    $table->string('groupable_type');
		    $table->integer('media_id')->nullable();
		    $table->integer('user_id');
		    $table->string('type');
		    $table->string('title');
		    $table->string('url');
		    $table->text('description');
		    $table->text('body');
		    $table->string('status');
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
		Schema::drop('posts');
	}

}
