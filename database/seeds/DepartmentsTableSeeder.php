<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::statement('TRUNCATE TABLE departments');

		DB::table('departments')->insert([
			['name' => '贺州市地税局', 'is_activated' => true],
			['name' => '富川县地税局', 'is_activated' => true],
			['name' => '八步县地税局', 'is_activated' => false],
			['name' => '钟山县地税局', 'is_activated' => true],
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
