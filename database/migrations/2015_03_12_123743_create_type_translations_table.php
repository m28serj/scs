<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeTranslationsTable extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 */
		public function up() {
				Schema::create('type_translations', function (Blueprint $table) {
						$table->integer('type_id');
						$table->integer('locale_id');
						$table->string('text', 255);
						$table->primary(['type_id', 'locale_id']);
				});
		}

		/**
		 * Reverse the migrations.
		 * @return void
		 */
		public function down() {
				Schema::drop('type_translations');
		}
}
