<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('geoname_id');
            $table->string('name', 255);
            $table->string('ascii_name', 255);
            $table->binary('alternate_names');
            $table->float('latitude', 8, 5);
            $table->float('longitude', 8, 5);
            $table->char('feature_class');
            $table->string('feature_code', 10);
            $table->string('country_code', 2);
            $table->string('cc2', 60);
            $table->string('admin1_code', 20);
            $table->string('admin2_code', 80);
            $table->string('admin3_code', 20);
            $table->string('admin4_code', 20);
            $table->bigInteger('population');
            $table->string('elevation', 50);
            $table->string('dem');
            $table->string('timezone', 40);
            $table->date('modification_date');
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
		Schema::drop('locations');
	}

}
