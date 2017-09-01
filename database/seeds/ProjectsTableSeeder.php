<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::statement('TRUNCATE TABLE projects');

		DB::table('projects')->insert([
			'name'            => '永贺高速公路项目',
			'building'        => '建设方',
			'building_number' => '2145251214432321321',
			'roadbed_amount'  => 8,
			'road_amount'     => 10,
			'investment'      => 15420589632.2,
			'kilometre'       => 58742152.3,
			'address'         => '工程地址',
			'begtime'         => '2005-12-01',
			'endtime'         => '2015-10-25',
			'authority'       => '主管税务机关',
			'bureau'          => '主管税务分局',
			'finance'         => '财务负责人',
			'finance_phone'   => '12345678901',
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
