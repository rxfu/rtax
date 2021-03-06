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
			$table->integer('section_id')->unsigned()->comment('标段ID');
			$table->string('specification_name', 50)->comment('规格名称');
			$table->string('tax_name', 100)->comment('税目');
			$table->string('unit')->comment('单位');
			$table->decimal('unit_price', 5, 2)->comment('单价');
			$table->decimal('total_amount', 15, 2)->comment('总数量');
			$table->string('flag', 10)->comment('资源税改革标记');
			$table->integer('rate_id_before')->unsigned()->comment('税目ID（改革前）');
			$table->decimal('taxamount_before', 15, 2)->comment('课税数量（改革前）');
			$table->decimal('payabletax_before', 15, 2)->comment('应纳税额（改革前）');
			$table->integer('rate_id_after')->unsigned()->comment('税目ID（改革后）');
			$table->decimal('taxamount_after', 15, 2)->comment('课税数量（改革后）');
			$table->decimal('payabletax_after', 15, 2)->comment('应纳税额（改革后）');
			$table->integer('completion_id')->unsigned()->comment('完工比例ID');
			$table->decimal('total', 15, 2)->comment('应纳资源税合计');
			$table->integer('user_id')->unsigned()->comment('用户ID');
			$table->string('year', 4)->comment('年度');
			$table->timestamps();

			$table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('completion_id')->references('id')->on('completions')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('rate_id_before')->references('id')->on('rates')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('rate_id_after')->references('id')->on('rates')->onUpdate('cascade')->onDelete('cascade');

			$table->index('specification_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('taxes');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
