<?php

use App\Models\Task;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder{

		public function run() {

				Task::truncate();

				Task::create(['group_id' => 1, 'type_id' => 1, 'offset' => 40])->periods()->sync(['3']);

				Task::create(['group_id' => 2, 'type_id' => 1, 'offset' => 40])->periods()->sync(['3']);

				Task::create(['group_id' => 3, 'type_id' => 1, 'offset' => 39])->periods()->sync(['2' => ['cumulative' => 1]]);

				Task::create(['group_id' => 4, 'type_id' => 1, 'offset' => 39])->periods()->sync(['2' => ['cumulative' => 1]]);

				Task::create(['group_id' => 5, 'type_id' => 1, 'offset' => 39])->periods()->sync(['2' => ['cumulative' => 1]]);

				Task::create(['group_id' => 6, 'type_id' => 1, 'offset' => 39])->periods()->sync(['2' => ['cumulative' => 1]]);

				Task::create(['group_id' => 1, 'type_id' => 2, 'offset' => 19])->periods()->sync(['1', '2']);

				Task::create(['group_id' => 2, 'type_id' => 2, 'offset' => 19])->periods()->sync(['1', '2']);

				Task::create(['group_id' => 3, 'type_id' => 2, 'offset' => 19])->periods()->sync(['1', '2']);

				Task::create(['group_id' => 5, 'type_id' => 2, 'offset' => 19])->periods()->sync(['1', '2']);

				Task::create(['group_id' => 1, 'type_id' => 3, 'offset' => 19, 'current_period' => 1])->periods()->sync(['1']);

				Task::create(['group_id' => 2, 'type_id' => 3, 'offset' => 19, 'current_period' => 1])->periods()->sync(['1']);

				Task::create(['group_id' => 3, 'type_id' => 3, 'offset' => 49])->periods()->sync(['2']);

				Task::create(['group_id' => 4, 'type_id' => 3, 'offset' => 49])->periods()->sync(['2']);

				Task::create(['group_id' => 5, 'type_id' => 3, 'offset' => 49])->periods()->sync(['2']);

				Task::create(['group_id' => 6, 'type_id' => 3, 'offset' => 49])->periods()->sync(['2']);


		}
}
