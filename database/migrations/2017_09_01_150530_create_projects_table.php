<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('projects', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->comment('项目名称');
			$table->string('building', 50)->comment('建设方');
			$table->string('building_number', 50)->comment('建设方纳税人识别号');
			$table->integer('roadbed_amount')->unsigned()->comment('路基标数量');
			$table->integer('road_amount')->unsigned()->comment('路面标数量');
			$table->decimal('investment', 15, 2)->comment('总投资额');
			$table->decimal('kilometre', 15, 2)->comment('总里程数');
			$table->string('address', 100)->comment('工程地址');
			$table->date('begtime')->comment('开工时间');
			$table->date('endtime')->comment('完工时间');
			$table->string('authority', 50)->comment('主管税务机关');
			$table->string('bureau', 50)->comment('主管税务分局');
			$table->string('finance', 50)->commment('财务负责人');
			$table->string('finance_phone', 50)->comment('财务负责人联系电话');
			$table->text('note')->nullable()->comment('备注');
			$table->timestamps();

			$table->index('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('projects');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
