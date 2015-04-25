<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifiedPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_photos', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('filename');
            $table->string('path');
	        $table->string('complete_path');
	        $table->string('complete_thumbnail_path');
            $table->integer('size');
            $table->string('extension', 3);
            $table->string('mimetype', 32);
            $table->integer('user_id')->unsigned()->index();
            $table->integer('classified_id')->unsigned()->index(); // If this is a child file, it'll be referenced here.
            $table->softDeletes();
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
		Schema::dropIfExists('classified_photos');
	}

}
