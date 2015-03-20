<?php namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Interval
 *
 * @property integer $id
 * @property string $start
 * @property integer $months
 * @property string $text_ru
 * @property string $text_uk
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task')->withPivot('cumulative[] $tasks
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereMonths($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereTextRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereTextUk($value)
 */

/**
 * App\Models\Interval
 *
 * @property integer $id
 * @property string $start
 * @property integer $months
 * @property string $text_ru
 * @property string $text_uk
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereMonths($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereTextRu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Interval whereTextUk($value)
 */
class Interval extends Model
{

    protected $table = 'intervals';

    protected $fillable = ['start', 'month', 'text_ru', 'text_uk'];

    public $timestamps = false;

    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task')->withPivot('cumulative');
    }

    public function getTextAttribute()
    {
        return $this->attributes['text_' . App::getLocale()];
    }

}
