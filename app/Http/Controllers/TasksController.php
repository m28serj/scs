<?php namespace App\Http\Controllers;

use App\Http\Requests\GetMessagesRequest;
use App\Models\Holiday;
use App\Models\Task;
use App;

class TasksController extends Controller {
		protected $holidays;
		protected $tasks;

		public function __construct(Task $tasks, Holiday $holidays) {
				$this->holidays = $holidays;
				$this->tasks = $tasks;
		}

		public function messages(GetMessagesRequest $request ) {
				App::setLocale($request->get('locale'));

				$holidays = $this->holidays->all()->keyBy('date');

				$tasks = $this->tasks->whereHas('group', function ($q) use ($request) {
						$q->where('id', '=', $request->get('group'));
				})->with(['group', 'periods', 'type', 'type.translations' => function ($q) {
						$q->where('locales.code', App::getLocale());
				}])->get();

				$messageGroups = [];
				foreach ($tasks as $task) {
						$messages = $task->messages($request->get('periodicity'), $request->get('year'), $request->get('date_from'), $request->get('date_to'), $holidays);
						if(!empty($messages)){
								$messageGroups[$task->type->id] = $messages;
						}
				}

				return response()->json(['status' => 'success', 'data' => $messageGroups]);
		}
}
