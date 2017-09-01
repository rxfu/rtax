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
			$table->integer('section_id')->unsigned()->comment('标段ID');
			$table->string('tax_name', 100)->comment('税目');
			$table->decimal('total', 15, 2)->comment('金额');
			$table->string('number', 50)->comment('税票号码');
			$table->date('issue_time')->comment('开具时间');
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

		Schema::dropIfExists('declarations');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
