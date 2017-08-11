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
			$table->integer('project_id')->unsigned()->comment('项目ID');
			$table->integer('amount')->unsigned()->comment('数量');
			$table->decimal('total', 15, 2)->comment('金额');
			$table->string('name', 100)->nullable()->comment('文件名');
			$table->string('pathname', 100)->nullable()->comment('文件路径');
			$table->string('ext', 10)->nullable()->comment('文件扩展名');
			$table->integer('user_id')->unsigned()->comment('用户ID');
			$table->timestamps();

			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users');

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

		Schema::dropIfExists('paids');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
