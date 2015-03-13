<?php

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaysSeeder extends Seeder{

		public function run() {
				//Russian language
				Holiday::truncate();

				Holiday::create(['date' => '1.1']);

				Holiday::create(['date' => '7.1']);

				Holiday::create(['date' => '8.3']);

				Holiday::create(['date' => '9.5']);

				Holiday::create(['date' => '8.6']);

				Holiday::create(['date' => '28.6']);

				Holiday::create(['date' => '24.8']);
		}
}
