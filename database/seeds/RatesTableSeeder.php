<?php

use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::statement('TRUNCATE TABLE rates');

		DB::table('rates')->insert([
			[
				'category' => '资源税',
				'flag'     => '前',
				'name'     => '建筑用砂和水泥配料用砂',
				'unit'     => '吨',
				'rate'     => 1.2,
			],
			[
				'category' => '资源税',
				'flag'     => '前',
				'name'     => '其他粘土(指非制砖用的各类黄土和其他土质的粘土)',
				'unit'     => '吨',
				'rate'     => 0.5,
			],
			[
				'category' => '资源税',
				'flag'     => '前',
				'name'     => '石灰石',
				'unit'     => '吨',
				'rate'     => 2,
			],
			[
				'category' => '资源税',
				'flag'     => '后',
				'name'     => '建筑用砂和水泥配料用砂',
				'unit'     => '立方米',
				'rate'     => 1.5,
			],
			[
				'category' => '资源税',
				'flag'     => '后',
				'name'     => '其他粘土(指非制砖用的各类黄土和其他土质的粘土)',
				'unit'     => '立方米',
				'rate'     => 0.5,
			],
			[
				'category' => '资源税',
				'flag'     => '后',
				'name'     => '石灰石',
				'unit'     => '元',
				'rate'     => 0.06,
			],
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
