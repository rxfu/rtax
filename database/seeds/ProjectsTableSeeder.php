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
			[
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基第一合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基第二合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基第三合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基第四合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基第五合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基第六合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路基隧道标合同段',
				'lot_type'     => '路基标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路面第一合同段',
				'lot_type'     => '路面标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路面第二合同段',
				'lot_type'     => '路面标',
				'user_id'      => '1',
			], [
				'project_name' => '永贺高速公路项目',
				'lot_name'     => '路面第三合同段',
				'lot_type'     => '路面标',
				'user_id'      => '1',
			],
		]);

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
