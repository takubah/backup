<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWidgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection( Config::get('asmoyo::config.database') )->create('widgets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
		    $table->text('description');
		    $table->text('content')->nullable();
		    $table->boolean('has_group');
		    $table->text('attribute');
		    $table->string('status');
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
		Schema::drop('widgets');
	}

}
