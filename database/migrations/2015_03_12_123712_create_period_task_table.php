<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeriodTaskTable extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 */
		public function up() {
				Schema::create('period_task', function (Blueprint $table) {
						$table->integer('task_id');
						$table->integer('period_id');
						$table->boolean('cumulative')->default(0);
						$table->unique(['task_id', 'period_id'], 'unique');
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::drop('period_task');
		}
}
