<?php namespace App\Models;

use App\Date;
use Lang;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Periodicity
 *
 * @property integer $id
 * @property string $interval
 * @property string $name_ru
 * @property string $name_uk
 * @property boolean $selectable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Interval[] $intervals
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereInterval($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereNameRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereNameUk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereSelectable($value)
 */

/**
 * App\Models\Periodicity
 *
 * @property integer $id
 * @property string $interval
 * @property string $name_ru
 * @property string $name_uk
 * @property boolean $selectable
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereInterval($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereNameRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereNameUk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Periodicity whereSelectable($value)
 */
class Periodicity extends Model
{

    protected $table = 'periodicities';

    protected $fillable = ['interval', 'name_ru', 'name_uk', 'selectable'];

    public $timestamps = false;

    public function intervals()
    {
        return $this->belongsToMany('App\Models\Interval');
    }
}
