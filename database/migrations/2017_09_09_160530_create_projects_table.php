<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('projects', function (Blueprint $table) {
			$table->increments('id');
			$table->string('project_name', 100)->comment('项目名称');
			$table->string('lot_name', 100)->comment('标段名称');
			$table->string('lot_type', 20)->comment('标段类型');
			$table->integer('user_id')->unsigned()->comment('用户ID');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');

			$table->index('project_name');
			$table->unique(['project_name', 'lot_name', 'lot_type']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('projects');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
