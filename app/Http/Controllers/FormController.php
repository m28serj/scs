<?php namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Period;
use App\Models\Locale;

class FormController extends Controller {

		protected $data;
		protected $groups;
		protected $locales;
		protected $periods;

		public function __construct(Group $groups, Period $periods, Locale $locales){

				$this->groups = $groups;
				$this->locales = $locales;
				$this->periods = $periods;
		}
		public function index() {

				$this->data['groups'] = $this->groups->all();
				$this->data['locales'] = $this->locales->all();
				$this->data['periods'] = $this->periods->where('selectable',1)->get();

				return view('form', $this->data);
		}

}
