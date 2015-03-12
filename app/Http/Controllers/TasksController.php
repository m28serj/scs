<?php namespace App\Http\Controllers;

use App\Http\Requests\GetMessagesRequest;
use App\Models\Holiday;
use App\Models\Task;
use App\Date;
use Lang;
use App;

class TasksController extends Controller {
		protected $holidays;
		protected $tasks;
		protected $data;

		public function __construct(Task $tasks, Holiday $holidays) {
				$this->holidays = $holidays;
				$this->tasks = $tasks;
		}

		public function messages(GetMessagesRequest $request) {
				App::setLocale($request->get('locale'));

				$holidays = $this->holidays->all()->keyBy('date');

				$tasks = $this->tasks->whereHas('group', function ($q) use ($request) {
						$q->where('id', '=', $request->get('group'));
				})->with(['group', 'periods', 'type', 'type.translations' => function ($query) {
						$query->where('locales.code', App::getLocale());
				}])->get();

				$this->data['messageGroups'] = [];

				foreach ($tasks as $task) {
						if (!$task->periods->isEmpty()) {

								$period = ($task->periods->count() > 1) ? $task->periods->keyBy('interval')->get($request->get('periodicity')) : $period = $task->periods->first();
								switch ($period->interval) {
										case 'month':
												for ($month = 1; $month <= 12; $month++) {

														$cumulative = $period->pivot->cumulative;
														$current = $task->current_period;

														$dateStartTaskPeriod = Date::createFromDate($request->get('year'), ($cumulative) ? 1 : ($month), 1);
														$dateStartPerformPeriod = ($current) ? $dateStartTaskPeriod->copy() : $dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addMonths(($cumulative) ? ($month) : 1) ;
														$dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($task->offset)->checkDate($task->group->offset_next, $holidays);

														if($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $request->get('date_from')), Date::createFromFormat('d.m.Y', $request->get('date_to')))){
																$this->data['messageGroups'][$task->type->id][] = $task->type->text . $dateEndPerformPeriod->format('F Y') . Lang::get('dates.to') . $dateEndPerformPeriod->checkDate($task->group->offset_next, $holidays)->format(' j f Y');
														}
												}
												break;
										case 'quarter':
												for ($quarter = 1; $quarter <= 4; $quarter++) {

														$cumulative = $period->pivot->cumulative;
														$current = $task->current_period;

														$dateStartTaskPeriod = Date::createFromDate($request->get('year'), ($cumulative) ? 1 : ($quarter * 3 - 2), 1);
														$dateStartPerformPeriod = ($current) ? $dateStartTaskPeriod->copy() : $dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addMonths(($cumulative) ? ($quarter * 3) : 3) ;
														$dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($task->offset)->checkDate($task->group->offset_next, $holidays);

														if($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $request->get('date_from')), Date::createFromFormat('d.m.Y', $request->get('date_to')))){
																$this->data['messageGroups'][$task->type->id][] = $task->type->text . Lang::get('dates.' . (($period->pivot->cumulative) ? 'cumulative_quarter_' . $quarter:'quarter'), ['number' => $quarter]) . Lang::get('dates.to') . $dateEndPerformPeriod->format(' j f Y');
														}
												}
												break;
										case 'year':
												$current = $task->current_period;

												$dateStartTaskPeriod = Date::createFromDate($request->get('year'), 1, 1);
												$dateStartPerformPeriod = ($current) ? $dateStartTaskPeriod->copy() : $dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addYear() ;
												$dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($task->offset)->checkDate($task->group->offset_next, $holidays);

												if($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $request->get('date_from')), Date::createFromFormat('d.m.Y', $request->get('date_to')))){
														$this->data['messageGroups'][$task->type->id][] = $task->type->text . Lang::get('dates.year', ['number' => $request->get('year')]) . Lang::get('dates.to') . $dateEndPerformPeriod->format(' j f Y');
												}
												break;
								}
						}
				}

				return view('partials/messages', $this->data);
		}
}
