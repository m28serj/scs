<?php namespace App\Models;

use App\Date;
use Lang;
use App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Task
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $type_id
 * @property integer $offset
 * @property boolean $current_period
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\Type $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Periodicity[] $periodicities
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereOffset($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereCurrentPeriod($value)
 */

/**
 * App\Models\Task
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $type_id
 * @property integer $offset
 * @property boolean $current_period
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Periodicity[] $messages
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereOffset($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereCurrentPeriod($value)
 */
class Task extends Model
{

    protected $table = 'tasks';

    protected $fillable = ['group_id', 'type_id', 'offset', 'current_period'];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function periodicities()
    {
        return $this->belongsToMany('App\Models\Periodicity');
    }

    public function messages($interval, $year, $dateFrom, $dateTo, $holidays)
    {
        $messages = [];
        $current = $this->current_period;

        if (!$this->periodicities->isEmpty()) {
            $periodicity = ($this->periodicities->count() > 1) ? $this->periodicities->keyBy('interval')->get($interval) : $this->periodicities->first();

            foreach ($periodicity->intervals as $interval) {

                $dateStartTaskPeriod = Date::createFromFormat('d.m.Y', $interval->start . '.' . $year);
                $dateStartPerformPeriod = ($current) ? $dateStartTaskPeriod->copy() : $dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addMonths($interval->months);
                $dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($this->offset)->checkDate($this->group->offset_next, $holidays);

                if ($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $dateFrom), Date::createFromFormat('d.m.Y', $dateTo))) {
                    $messages[] = $this->type->attributes['text_' . App::getLocale()] . ' ' . str_replace(['{year}'], [$year], $interval->attributes['text_' . App::getLocale()]) . ' ' . Lang::get('dates.to') . $dateEndPerformPeriod->checkDate($this->group->offset_next, $holidays)->format(' j f Y');
                }
            }
        }
        return $messages;
    }
}
