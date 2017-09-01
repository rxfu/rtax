<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sections', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('project_id')->unsigned()->comment('项目ID');
			$table->string('name', 100)->comment('标段名称');
			$table->integer('type_id')->unsigned()->comment('标段类型ID');
			$table->string('building', 50)->comment('建设方');
			$table->string('constructor', 50)->comment('施工方');
			$table->decimal('investment', 15, 2)->comment('投资额');
			$table->decimal('kilometre', 15, 2)->comment('里程数');
			$table->string('address', 100)->comment('工程地址');
			$table->date('begtime')->comment('开工时间');
			$table->date('endtime')->comment('完工时间');
			$table->string('authority', 50)->comment('主管税务机关');
			$table->string('bureau', 50)->comment('主管税务分局');
			$table->string('finance', 50)->commment('财务负责人');
			$table->string('finance_phone', 50)->comment('财务负责人联系电话');
			$table->string('bank', 50)->comment('开户银行');
			$table->string('bank_name', 50)->comment('开户行名称');
			$table->string('bank_account', 50)->comment('开户行账号');
			$table->text('note')->nullable()->comment('备注');
			$table->timestamps();

			$table->index('name');

			$table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Schema::dropIfExists('sections');

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
