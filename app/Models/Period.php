<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model {

		protected $table = 'periods';

		protected $fillable = ['interval', 'name', 'selectable'];

		public $timestamps = false;

		public function tasks() {
				return $this->belongsToMany('App\Models\Task')->withPivot('cumulative');
		}

}
