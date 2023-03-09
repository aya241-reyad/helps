<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHelpsTable extends Migration {

	public function up()
	{
		Schema::create('helps', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->string('description', 191);
			$table->string('longitude', 191);
			$table->string('attitude', 191);
		});
	}

	public function down()
	{
		Schema::drop('helps');
	}
}