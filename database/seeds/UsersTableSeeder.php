<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('TRUNCATE TABLE users');

		User::create([
			'username' => 'admin',
			'email'    => 'admin@test.com',
			'password' => bcrypt('123456'),
			'name'     => '系统管理员',
			'is_admin' => true,
		]);
	}
}
