<?php namespace App\Models;

use App\Date;
use Lang;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Period')->withPivot('cumulative[] $periods 
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Period')->withPivot('cumulative[] $messages 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereGroupId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereOffset($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereCurrentPeriod($value)
 */
class Task extends Model {

		protected $table = 'tasks';

		protected $fillable = ['group_id', 'type_id', 'offset', 'current_period'];

		public $timestamps = false;

		public function group() {
				return $this->belongsTo('App\Models\Group');
		}

		public function type() {
				return $this->belongsTo('App\Models\Type');
		}

		public function periods() {
				return $this->belongsToMany('App\Models\Period')->withPivot('cumulative');
		}

		public function messages($periodicity, $year, $dateFrom, $dateTo, $holidays) {
				$messages = [];
				if (!$this->periods->isEmpty()) {
						$period = ($this->periods->count() > 1)?$this->periods->keyBy('interval')->get($periodicity):$period = $this->periods->first();
						switch ($period->interval) {
								case 'month':
										for ($month = 1; $month <= 12; $month++) {
												$cumulative = $period->pivot->cumulative;
												$current = $this->current_period;

												$dateStartTaskPeriod = Date::createFromDate($year, ($cumulative)?1:($month), 1);
												$dateStartPerformPeriod = ($current)?$dateStartTaskPeriod->copy():$dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addMonths(($cumulative)?($month):1);
												$dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($this->offset)->checkDate($this->group->offset_next, $holidays);

												if ($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $dateFrom), Date::createFromFormat('d.m.Y', $dateTo)) ) {
														$messages[] = $this->type->text.$dateEndPerformPeriod->format('F Y').Lang::get('dates.to').$dateEndPerformPeriod->checkDate($this->group->offset_next, $holidays)->format(' j f Y');
												}
										}
										break;
								case 'quarter':
										for ($quarter = 1; $quarter <= 4; $quarter++) {
												$cumulative = $period->pivot->cumulative;
												$current = $this->current_period;

												$dateStartTaskPeriod = Date::createFromDate($year, ($cumulative)?1:($quarter * 3 - 2), 1);
												$dateStartPerformPeriod = ($current)?$dateStartTaskPeriod->copy():$dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addMonths(($cumulative)?($quarter * 3):3);
												$dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($this->offset)->checkDate($this->group->offset_next, $holidays);

												if ($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $dateFrom), Date::createFromFormat('d.m.Y', $dateTo)) ) {
														$messages[] = $this->type->text.Lang::get('dates.'.(($period->pivot->cumulative)?'cumulative_quarter_'.$quarter:'quarter'), ['number' => $quarter]).Lang::get('dates.to').$dateEndPerformPeriod->format(' j f Y');
												}
										}
										break;
								case 'year':
										$current = $this->current_period;

										$dateStartTaskPeriod = Date::createFromDate($year, 1, 1);
										$dateStartPerformPeriod = ($current)?$dateStartTaskPeriod->copy():$dateStartPerformPeriod = $dateStartTaskPeriod->copy()->addYear();
										$dateEndPerformPeriod = $dateStartPerformPeriod->copy()->addDays($this->offset)->checkDate($this->group->offset_next, $holidays);
										
										if ($dateStartPerformPeriod->between(Date::createFromFormat('d.m.Y', $dateFrom), Date::createFromFormat('d.m.Y', $dateTo)) ) {
												$messages[] = $this->type->text.Lang::get('dates.year', ['number' => $year]).Lang::get('dates.to').$dateEndPerformPeriod->format(' j f Y');
										}
										break;
						}
				}
				return $messages;
		}
}
