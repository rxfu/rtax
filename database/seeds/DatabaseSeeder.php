<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(DepartmentsTableSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(RatesTableSeeder::class);
		$this->call(ProjectsTableSeeder::class);
		$this->call(CompletionsTableSeeder::class);
	}
}
