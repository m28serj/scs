<?php namespace App\Http\Controllers;

use App\Http\Requests\GetMessagesRequest;
use App\Models\Holiday;
use App\Models\Task;
use App\Date;
use Lang;
use App;

class TasksController extends Controller
{
    protected $holidays;
    protected $tasks;

    public function __construct(Task $tasks, Holiday $holidays)
    {
        $this->holidays = $holidays;
        $this->tasks = $tasks;
    }

    public function messages(GetMessagesRequest $request)
    {
        App::setLocale($request->get('locale'));

        $holidays = $this->holidays->all()->keyBy('date');

        $tasks = $this->tasks->whereHas('group', function ($q) use ($request) {
            $q->where('id', '=', $request->get('group'));
        })->with(['group', 'periodicities', 'periodicities.intervals', 'type'])->get();

        $messageGroups = [];
        foreach ($tasks as $task) {
            $messages = [];
            $current = $task->current_period;

            if (!$task->periodicities->isEmpty()) {
                $periodicity = ($task->periodicities->count() > 1) ? $task->periodicities->keyBy('interval')->get($request->get('interval')) : $task->periodicities->first();
                foreach ($periodicity->intervals as $interval) {
                    $dateStartTaskPeriod = Date::createFromFormat('d.m.Y', $interval->start . '.' . $request->get('year'));
                    $dateStartPerformPeriod = ($current) ? $dateStartTaskPeriod->copy() : $dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addMonths($interval->months);
                    $dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($task->offset)->checkDate($task->group->offset_next, $holidays);

                    if ($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $request->get('date_from')), Date::createFromFormat('d.m.Y', $request->get('date_to')))) {
                        $messages[] = $task->type->attributes['text_' . App::getLocale()] . ' ' . str_replace(['{year}'], [$request->get('year')], $interval->attributes['text_' . App::getLocale()]) . ' ' . Lang::get('dates.to') . $dateEndPerformPeriod->checkDate($task->group->offset_next, $holidays)->format(' j f Y');
                    }
                }
            }
            if (!empty($messages)) {
                $messageGroups[$task->type->id] = $messages;
            }
        }

        return response()->json(['status' => 'success', 'data' => $messageGroups]);
    }
}
