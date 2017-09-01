<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::statement('TRUNCATE TABLE types');

		DB::table('types')->insert([
			['name' => '路基标'],
			['name' => '路面标'],
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
