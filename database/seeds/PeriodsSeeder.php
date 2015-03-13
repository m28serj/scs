<?php

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodsSeeder extends Seeder{

		public function run() {

				Period::truncate();

				Period::create(['interval' => 'month', 'name' => 'Месяц', 'selectable' => 1]);

				Period::create(['interval' => 'quarter', 'name' => 'Квартал', 'selectable' => 1]);

				Period::create(['interval' => 'year', 'name' => 'Год']);

		}
}
