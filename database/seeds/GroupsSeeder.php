<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder{

		public function run() {

				Group::truncate();

				Group::create([]);

				Group::create([]);

				Group::create([]);

				Group::create([]);

				Group::create([]);

				Group::create([]);
		}
}

