<?php namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Period;
use App\Models\Locale;

class FormController extends Controller {

		public function index(Group $groups, Period $periods, Locale $locales) {

				$data['groups'] = $groups->all();
				$data['locales'] = $locales->all();
				$data['periods'] = $periods->whereSelectable(1)->get();

				return view('form', $data);
		}

}
