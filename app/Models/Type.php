<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App;

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
