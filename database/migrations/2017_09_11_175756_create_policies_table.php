<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('policies', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->comment('文件名');
			$table->string('pathname', 100)->comment('文件路径');
			$table->string('ext', 10)->comment('文件扩展名');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('policies');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
