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
				'section_id'        => 1,
				'completion_before' => 58,
				'completion_after'  => 42,
				'user_id'           => 1,
			], [
				'section_id'        => 2,
				'completion_before' => 64,
				'completion_after'  => 36,
				'user_id'           => 1,
			], [
				'section_id'        => 3,
				'completion_before' => 55,
				'completion_after'  => 45,
				'user_id'           => 1,
			], [
				'section_id'        => 4,
				'completion_before' => 58,
				'completion_after'  => 42,
				'user_id'           => 1,
			], [
				'section_id'        => 5,
				'completion_before' => 54,
				'completion_after'  => 46,
				'user_id'           => 1,
			], [
				'section_id'        => 6,
				'completion_before' => 65,
				'completion_after'  => 35,
				'user_id'           => 1,
			], [
				'section_id'        => 7,
				'completion_before' => 62,
				'completion_after'  => 38,
				'user_id'           => 1,
			], [
				'section_id'        => 8,
				'completion_before' => 0,
				'completion_after'  => '100',
				'user_id'           => 1,
			], [
				'section_id'        => 9,
				'completion_before' => 0,
				'completion_after'  => '100',
				'user_id'           => 1,
			], [
				'section_id'        => 10,
				'completion_before' => 0,
				'completion_after'  => '100',
				'user_id'           => 1,
			],
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
