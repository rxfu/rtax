<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('paids', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->unsigned()->comment('标段ID');
			$table->string('tax_name', 100)->comment('税目');
			$table->string('unit')->comment('计量单位');
			$table->decimal('amount', 15, 2)->comment('数量');
			$table->decimal('total', 15, 2)->comment('金额');
			$table->date('issue_time')->comment('开具时间');
			$table->string('authority', 50)->comment('开具证明税务机关');
			$table->string('sale', 100)->comment('销售单位');
			$table->string('name', 100)->nullable()->comment('文件名');
			$table->string('pathname', 100)->nullable()->comment('文件路径');
			$table->string('ext', 10)->nullable()->comment('文件扩展名');
			$table->integer('user_id')->unsigned()->comment('用户ID');
			$table->string('year', 4)->comment('年度');
			$table->timestamps();

			$table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users');

			$table->index('tax_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('paids');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
