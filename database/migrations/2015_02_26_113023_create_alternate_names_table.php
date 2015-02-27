<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternateNamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alternate_names', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('alternate_name_id');
            $table->integer('geoname_id');
            $table->string('isolanguage', 7);
            $table->binary('alternate_name');
            $table->boolean('is_preferred_name');
            $table->boolean('is_short_name');
            $table->boolean('is_colloquial');
            $table->boolean('is_historic');
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
		Schema::drop('alternate_names');
	}

}
