<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWidgetsGroupsItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('widgets_groups_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('widget_group_id');
			$table->integer('objectable_id')->nullable();
			$table->string('objectable_type')->nullable();
			$table->text('content');
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
		Schema::drop('widgets_groups_items');
	}

}
