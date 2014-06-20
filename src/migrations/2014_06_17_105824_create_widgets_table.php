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
			$table->integer('objectable_id')->nullable();
			$table->string('objectable_type')->nullable();
			$table->string('title');
		    $table->text('description');
		    $table->text('content')->nullable();
		    $table->string('view_path');
		    $table->boolean('is_hasMany');
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
