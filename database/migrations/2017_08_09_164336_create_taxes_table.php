<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('taxes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('category', 50)->comment('税种');
			$table->string('flag', 10)->comment('资源税改革标记');
			$table->string('name', 50)->comment('税目');
			$table->string('unit', 10)->comment('计量单位');
			$table->decimal('rate', 5, 2)->comment('税率');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('taxes');
	}
}
