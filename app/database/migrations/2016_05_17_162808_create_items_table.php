<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('items', function($table)
    {
            $table->increments('id');
						$table->String('title');
						$table->text('description');
						$table->String('guid',512);
						$table->String('link',512);
						$table->String('pubdate');
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
		//
		Schema::drop('items');
	}

}
