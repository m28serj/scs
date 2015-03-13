<?php namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class GetMessagesRequest extends Request {
		/**
		 * Determine if the user is authorized to make this request.
		 * @return bool
		 */
		public function authorize() {
				return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 * @return array
		 */
		public function rules() {
				return [
						'group'       => 'required|numeric|exists:groups,id',
						'periodicity' => 'required|exists:periods,interval|in:month,quarter',
						'year'        => 'required|date_format:Y',
						'date_from' 	=> 'required|date_format:d.m.Y',
						'date_to'     => 'required|date_format:d.m.Y|after:date_from',
						'locale'		=> 'required|exists:locales,code',];
		}
}
