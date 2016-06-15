<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeedAddMetadataFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
	 {
		 Schema::table('feeds', function($table){
				 $table->text('link');
				 $table->string('description');
				 $table->text('language');
		 });
	 }

	 /**
		* Reverse the migrations.
		*
		* @return void
		*/
	 public function down()
	 {
		 $table->dropColumn('link');
		 $table->dropColumn('description');
		 $table->dropColumn('language');
	 }
}
