<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Period
 *
 * @property integer $id 
 * @property string $interval 
 * @property string $name 
 * @property boolean $selectable 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task')->withPivot('cumulative[] $tasks 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereInterval($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereSelectable($value)
 */
/**
 * App\Models\Period
 *
 * @property integer $id 
 * @property string $interval 
 * @property string $name 
 * @property boolean $selectable 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereInterval($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Period whereSelectable($value)
 */
class Period extends Model {

		protected $table = 'periods';

		protected $fillable = ['interval', 'name', 'selectable'];

		public $timestamps = false;

		public function tasks() {
				return $this->belongsToMany('App\Models\Task')->withPivot('cumulative');
		}

}
