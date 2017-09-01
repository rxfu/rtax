<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('types', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->comment('类型名称');
			$table->text('note')->nullable()->comment('备注');
			$table->timestamps();

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

		Schema::dropIfExists('types');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
