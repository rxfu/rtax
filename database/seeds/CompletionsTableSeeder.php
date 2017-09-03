<?php

use Illuminate\Database\Seeder;

class CompletionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::statement('TRUNCATE TABLE completions');

		DB::table('completions')->insert([
			[
				'section_id' => 1,
				'before'     => 58,
				'after'      => 42,
				'user_id'    => 1,
			], [
				'section_id' => 2,
				'before'     => 64,
				'after'      => 36,
				'user_id'    => 1,
			], [
				'section_id' => 3,
				'before'     => 55,
				'after'      => 45,
				'user_id'    => 1,
			], [
				'section_id' => 4,
				'before'     => 58,
				'after'      => 42,
				'user_id'    => 1,
			], [
				'section_id' => 5,
				'before'     => 54,
				'after'      => 46,
				'user_id'    => 1,
			], [
				'section_id' => 6,
				'before'     => 65,
				'after'      => 35,
				'user_id'    => 1,
			], [
				'section_id' => 7,
				'before'     => 62,
				'after'      => 38,
				'user_id'    => 1,
			], [
				'section_id' => 8,
				'before'     => 0,
				'after'      => '100',
				'user_id'    => 1,
			], [
				'section_id' => 9,
				'before'     => 0,
				'after'      => '100',
				'user_id'    => 1,
			], [
				'section_id' => 10,
				'before'     => 0,
				'after'      => '100',
				'user_id'    => 1,
			],
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
