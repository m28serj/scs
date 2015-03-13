<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeriodsTable extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 */
		public function up() {
				Schema::create('periods', function (Blueprint $table) {
						$table->integer('id', true);
						$table->string('interval');
						$table->string('name', 32);
						$table->boolean('selectable')->default(0);
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::drop('periods');
		}
}
