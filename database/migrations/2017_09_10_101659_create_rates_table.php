<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('rates', function (Blueprint $table) {
			$table->increments('id');
			$table->string('category', 50)->comment('税种');
			$table->string('flag', 10)->comment('资源税改革标记');
			$table->string('name', 100)->comment('税目');
			$table->string('unit', 10)->comment('计量单位');
			$table->decimal('rate', 15, 2)->comment('税率');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('rates');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
