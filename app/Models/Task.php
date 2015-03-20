<?php namespace App\Models;

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
}
