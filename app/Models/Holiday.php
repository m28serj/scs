<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Holiday
 *
 * @property integer $id 
 * @property string $date 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Holiday whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Holiday whereDate($value)
 */
/**
 * App\Models\Holiday
 *
 * @property integer $id 
 * @property string $date 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Holiday whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Holiday whereDate($value)
 */
class Holiday extends Model {

		protected $table = 'holidays';

		protected $fillable = ['data'];

		public $timestamps = false;
}
