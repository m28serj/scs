<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {
		/**
		 * Run the database seeds.
		 * @return void
		 */
		public function run() {
				Model::unguard();

				$this->call('HolidaysSeeder');
				$this->call('GroupsSeeder');
				$this->call('PeriodsSeeder');
				$this->call('LocalesSeeder');
				$this->call('TypesSeeder');
				$this->call('TasksSeeder');
		}
}
