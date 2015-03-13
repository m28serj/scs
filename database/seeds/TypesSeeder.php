<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder{

		public function run() {

				Type::truncate();

				Type::create(['offset_next' => 1])->translations()->sync(['1' => ['text' => 'Сдать налоговую декларацию за '],
																																	'2' => ['text' => 'Здати податкову декларацію за ']]);

				Type::create([])->translations()->sync(['1' => ['text' => 'Оплатить ЕСВ за '],
																								'2' => ['text' => 'Cплатити ЄСВ за ']]);

				Type::create([])->translations()->sync(['1' => ['text' => 'Оплатить ЕН за '],
																								'2' => ['text' => 'Cплатити ЄН за ']]);

		}
}
