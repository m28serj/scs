<?php namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Periodicity;
use App\Models\Locale;

class FormController extends Controller
{

    public function index(Group $groups, Periodicity $periodicities, Locale $locales)
    {

        $data['groups'] = $groups->all();
        $data['locales'] = $locales->all();
        $data['periodicities'] = $periodicities->whereSelectable(1)->get();

        return view('form', $data);
    }

}
