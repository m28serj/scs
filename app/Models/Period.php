<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model {

		/**
		 * The database table used by the model.
		 *
		 * @var string
		 */
		protected $table = 'periods';

		public function tasks() {
				return $this->belongsToMany('App\Models\Task')->withPivot('cumulative');
		}

}
