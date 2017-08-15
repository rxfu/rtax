<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclarationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('declarations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned()->comment('项目ID');
			$table->decimal('total', 15, 2)->comment('金额');
			$table->integer('user_id')->unsigned()->comment('用户ID');
			$table->string('year', 4)->comment('年度');
			$table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
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

		Schema::dropIfExists('declarations');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
