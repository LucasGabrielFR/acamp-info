<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Camper;
use App\Models\Person;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $countPeople = Person::count();
        $countCampers = Camper::distinct('person_id')
        ->join('people as p', 'person_id', '=', 'p.id')
        ->count('person_id');
        $countCamps = Camp::count();
        $camps = Camp::get();
        $nextCamp = Camp::whereRaw('date_start > NOW()')->orderBy('date_start')->first();

        return view('admin.pages.dashboard',[
            'countPeople' => $countPeople,
            'countCampers' => $countCampers,
            'countCamps' => $countCamps,
            'camps' => $camps,
            'nextCamp' => $nextCamp
        ]);
    }
}
