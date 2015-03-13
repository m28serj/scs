<?php

use App\Models\Locale;
use Illuminate\Database\Seeder;

class LocalesSeeder extends Seeder{

		public function run() {

				Locale::truncate();

				Locale::create(['code' => 'ru', 'name' => 'Русский']);

				Locale::create(['code' => 'uk', 'name' => 'Украинский']);

		}
}
