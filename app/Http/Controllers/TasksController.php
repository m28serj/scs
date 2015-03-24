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

        $tasks = $this->tasks->whereHas(
            'group',
            function ($q) use ($request) {
                $q->where('id', '=', $request->get('group'));
            }
        )->with(['group', 'periodicities', 'periodicities.intervals', 'type'])->get();

        $messageGroups = [];
        foreach ($tasks as $task) {
            if (!$task->periodicities->isEmpty()) {
                if ($task->periodicities->count() > 1) {
                    $periodicity = $task->periodicities->keyBy('interval')->get($request->get('interval'));
                } else {
                    $periodicity = $task->periodicities->first();
                }
                foreach ($periodicity->intervals as $interval) {
                    $start_task = Date::createFromFormat('d.m.Y', $interval->start . '.' . $request->get('year'));
                    if ($task->current_period) {
                        $start_perform = $start_task->copy();
                    } else {
                        $start_perform = $start_task->copy()->addMonths($interval->months);
                    }
                    $end_perform = $start_perform->copy()->addDays($task->offset)->checkDate($task->group->offset_next, $holidays);

                    if ($start_perform->between(Date::createFromFormat('d.m.Y', $request->get('date_from')), Date::createFromFormat('d.m.Y', $request->get('date_to')))) {
                        $messageGroups[$task->type->id][] = $task->type->text . ' ' . strtr($interval->text, ['{year}' => $request->get('year')]) . ' ' . Lang::get('dates.to') . $end_perform->checkDate($task->group->offset_next, $holidays)->format(' j f Y');
                    }
                }
            }
        }

        return response()->json(['status' => 'success', 'data' => $messageGroups]);
    }
}
