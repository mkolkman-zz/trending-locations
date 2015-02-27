<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mentions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->float('source_latitude', 8, 5);
            $table->float('source_longitude', 8, 5);
            $table->float('subject_latitude', 8, 5);
            $table->float('subject_longitude', 8, 5);
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
		Schema::drop('mentions');
	}

}
