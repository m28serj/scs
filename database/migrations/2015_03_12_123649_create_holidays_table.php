<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHolidaysTable extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 */
		public function up() {
				Schema::create('holidays', function (Blueprint $table) {
						$table->integer('id', true);
						$table->string('date', 5);
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::drop('holidays');
		}
}
