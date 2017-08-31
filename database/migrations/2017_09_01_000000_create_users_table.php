<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username', 50)->unique()->comment('用户名');
			$table->string('password', 128)->comment('密码');
			$table->integer('department_id')->comment('单位ID');
			$table->string('name', 50)->nullable()->comment('真实姓名');
			$table->string('phone', 50)->nullable()->comment('电话号码');
			$table->boolean('is_admin')->default(false)->comment('是否系统管理员');
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('users');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
