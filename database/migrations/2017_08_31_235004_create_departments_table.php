<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('departments', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->comment('单位名称');
			$table->boolean('is_activated')->default(true)->comment('启用标志，0是未启用，1是启用');
			$table->text('description')->nullable()->comment('备注');

			$table->index('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('departments');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
