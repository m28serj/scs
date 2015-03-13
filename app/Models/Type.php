<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App;

/**
 * App\Models\Type
 *
 * @property integer $id 
 * @property boolean $offset_next 
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Locale[] $translations 
 * @property-read mixed $text 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Type whereOffsetNext($value)
 */
/**
 * App\Models\Type
 *
 * @property integer $id 
 * @property boolean $offset_next 
 * @property-read mixed $text 
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Type whereOffsetNext($value)
 */
class Type extends Model {

		protected $table = 'types';

		protected $fillable = ['offset_next'];

		public $timestamps = false;

		public function translations() {
				return $this->belongsToMany('App\Models\Locale', 'type_translations')->withPivot('text');
		}

		public function translation($code) {
				return $this->translations->keyBy('code')->get($code)->pivot;
		}

		public function getTextAttribute() {
				return $this->translation(App::getLocale())->text;
		}

}
