<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWidgetsItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('widgets_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('widget_id')->nullable();
			$table->integer('widget_group_id')->nullable();
			$table->integer('parent_id')->nullable();
			$table->integer('order')->nullable();
			$table->integer('objectable_id')->nullable();
			$table->string('objectable_type')->nullable();
			$table->string('title')->nullable();
			$table->text('content')->nullable();
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
		Schema::drop('widgets_items');
	}

}
