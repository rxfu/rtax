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
			$table->string('email', 50)->unique()->comment('Email邮箱');
			$table->string('password', 128)->comment('密码');
			$table->string('name', 50)->comment('真实姓名');
			$table->integer('role')->unsigned()->default(1)->comment('角色，0是系统管理员，1是评估人员');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
