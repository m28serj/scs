<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalesTable extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 */
		public function up() {
				Schema::create('locales', function (Blueprint $table) {
						$table->integer('id', true);
						$table->string('code', 2);
						$table->string('name', 32);
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::drop('locales');
		}
}
