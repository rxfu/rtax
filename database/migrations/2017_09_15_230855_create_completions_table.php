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
			$table->integer('project_id')->unsigned()->comment('项目ID');
			$table->decimal('completion_before', 5, 2)->comment('改革前完工比例%');
			$table->decimal('completion_after', 5, 2)->comment('改革后完工比例%');
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
