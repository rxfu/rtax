<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::statement('TRUNCATE TABLE users');

		DB::table('users')->insert([
			'username' => 'admin',
			'email'    => 'admin@test.com',
			'password' => bcrypt('123456'),
			'name'     => '系统管理员',
			'is_admin' => true,
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
