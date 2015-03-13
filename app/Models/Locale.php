<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Locale
 *
 * @property integer $id 
 * @property string $code 
 * @property string $name 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Locale whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Locale whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Locale whereName($value)
 */
/**
 * App\Models\Locale
 *
 * @property integer $id 
 * @property string $code 
 * @property string $name 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Locale whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Locale whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Locale whereName($value)
 */
class Locale extends Model {

		protected $table = 'locales';

		protected $fillable = ['code', 'name'];

		public $timestamps = false;
}
