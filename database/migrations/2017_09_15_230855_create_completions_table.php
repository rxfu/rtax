<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('completions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->unsigned()->comment('标段ID');
			$table->decimal('before', 5, 2)->comment('改革前完工比例%');
			$table->decimal('after', 5, 2)->comment('改革后完工比例%');
			$table->integer('user_id')->unsigned()->comment('用户ID');
			$table->timestamps();

			$table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('completions');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
