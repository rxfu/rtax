<?php

use Carbon\Carbon;
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
			'username'      => 'admin',
			'password'      => bcrypt('123456'),
			'department_id' => 1,
			'name'          => '系统管理员',
			'phone'         => '13601458742',
			'is_admin'      => true,
			'created_at'    => Carbon::now(),
			'updated_at'    => Carbon::now(),
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
