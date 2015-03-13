<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 */
		public function up() {
				Schema::create('tasks', function (Blueprint $table) {
						$table->integer('id', true);
						$table->integer('group_id');
						$table->integer('type_id');
						$table->integer('offset');
						$table->boolean('current_period')->default(0);
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::drop('tasks');
		}
}
