<?php

namespace App\Repositories;

use App\Models\AcampType;
use App\Models\Camp;
use App\Models\Camper;
use App\Models\Servant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampRepository
{
    protected $entity;

    public function __construct(Camp $model)
    {
        $this->entity = $model;
    }

    public function getAllCamps()
    {
        return $this->entity->orderBy('name')->get();
    }

    public function storeCamp(Request $request)
    {
        $this->entity->create($request->all());
    }

    public function getCamp($id)
    {
        $camp = $this->entity->where('id', $id)->first();

        return $camp;
    }

    public function updateCamp($camp, $data)
    {
        $camp->update($data);
    }

    public function deleteCamp($camp)
    {
        $camp->delete();
    }

    public function getAllTypes()
    {
        return AcampType::all();
    }

    public function getCampers($id)
    {
        $campers = DB::table('campers as c')->select(
            'c.person_id',
            'c.id',
            'c.group',
            'p.name',
            'p.date_birthday',
            'p.contact',
            'p.parish',
        )
            ->join('people as p', 'p.id', '=', 'c.person_id')
            ->where('camp_id', $id)->get();
        return $campers;
    }

    public function getServants($id)
    {
        $servants = DB::table('servants as s')->select(
            's.person_id',
            's.id',
            's.group',
            's.sector',
            's.hierarchy',
            'p.name',
            'p.date_birthday',
            'p.contact',
            'p.parish',
        )
            ->join('people as p', 'p.id', '=', 's.person_id')
            ->where('camp_id', $id)->get();
        return $servants;
    }

    public function getNoCampers($id)
    {
        $campers = DB::table('people as p')
            ->whereNotIn('p.id', DB::table('campers')
                ->select('person_id')->where('camp_id', '=', $id))
            ->whereNotIn('p.id', DB::table('servants')
                ->select('person_id')->where('camp_id', '=', $id))->get();
        return $campers;
    }

    public function getNoServantsForFac($id)
    {
        $servants = DB::table('people as p')
            ->select(
                'p.name',
                'p.date_birthday',
                'p.contact',
                'p.parish',
                'p.id'
            )
            ->join('campers as ca', 'p.id', '=', 'ca.person_id')
            ->join('camps as c', 'c.id', '=', 'ca.camp_id')
            ->whereNotIn('p.id', DB::table('campers')->select('person_id')->where('camp_id', '=', $id))
            ->whereNotIn('p.id', DB::table('servants')->select('person_id')->where('camp_id', '=', $id))->get();
        return $servants;
    }

    public function getNoServantsForFacSearch(Request $request, $id)
    {
        $servants = DB::table('people as p')
            ->select(
                'p.name',
                'p.date_birthday',
                'p.contact',
                'p.parish',
                'p.id'
            )
            ->join('campers as ca', 'p.id', '=', 'ca.person_id')
            ->join('camps as c', 'c.id', '=', 'ca.camp_id')
            ->where('p.name', 'LIKE', '%' . $request->search . '%')
            ->whereNotIn('p.id', DB::table('campers')->select('person_id')->where('camp_id', '=', $id))
            ->whereNotIn('p.id', DB::table('servants')->select('person_id')->where('camp_id', '=', $id))->get();
        return $servants;
    }

    public function getNoServantsForSenior($id)
    {
        $servants = DB::table('people as p')
            ->select(
                'p.name',
                'p.date_birthday',
                'p.contact',
                'p.parish',
                'p.id'
            )
            ->join('campers as ca', 'p.id', '=', 'ca.person_id')
            ->join('camps as c', 'c.id', '=', 'ca.camp_id')
            ->join('acamp_types as act', 'act.id', '=', 'c.type_id')
            ->where('act.order', '=', '3')
            ->whereNotIn('p.id', DB::table('campers')->select('person_id')->where('camp_id', '=', $id))
            ->whereNotIn('p.id', DB::table('servants')->select('person_id')->where('camp_id', '=', $id))->get();
        return $servants;
    }

    public function getNoServantsForSeniorSearch(Request $request, $id)
    {
        $servants = DB::table('people as p')
            ->select(
                'p.name',
                'p.date_birthday',
                'p.contact',
                'p.parish',
                'p.id'
            )
            ->join('campers as ca', 'p.id', '=', 'ca.person_id')
            ->join('camps as c', 'c.id', '=', 'ca.camp_id')
            ->join('acamp_types as act', 'act.id', '=', 'c.type_id')
            ->where('act.order', '=', '3')
            ->where('p.name', 'LIKE', '%' . $request->search . '%')
            ->whereNotIn('p.id', DB::table('campers')->select('person_id')->where('camp_id', '=', $id))
            ->whereNotIn('p.id', DB::table('servants')->select('person_id')->where('camp_id', '=', $id))->get();
        return $servants;
    }

    public function getNoCampersSearch(Request $request, $id)
    {
        $campers = DB::table('people as p')
            ->where('p.name', 'LIKE', '%' . $request->search . '%')
            ->whereNotIn('p.id', DB::table('campers')->select('person_id')->where('camp_id', '=', $id))
            ->whereNotIn('p.id', DB::table('servants')
                ->select('person_id')->where('camp_id', '=', $id))->get();
        return $campers;
    }

    public function addCampers(Request $request, $id)
    {
        foreach ($request->campers as $new) {
            $camper = new Camper;
            $camper->person_id = $new;
            $camper->camp_id = $id;
            $camper->save();
        }
    }

    public function addCamper(Request $request)
    {
        $camper = new Camper;
        $camper = $camper->where('person_id', $request->person_id)->where('camp_id', $request->camp_id)->first();
        if(!$camper){
            $camper = new Camper;
            $camper->person_id = $request->person_id;
            $camper->camp_id = $request->camp_id;
            $camper->group = $request->tribo;
            $camper->save();
            return true;
        }else{
            return false;
        }
    }

    public function getCamper($id)
    {
        $camper = Camper::where('id', $id)->first();

        return $camper;
    }

    public function getServant($id)
    {
        $servant = Servant::where('id', $id)->first();

        return $servant;
    }

    public function deleteCamper($camper)
    {
        $camper->delete();
    }

    public function changeGroup($camper, $group)
    {
        $camper->group = $group;
        $camper->update();
    }

    public function changeSector($servant, $sector)
    {
        $servant->sector = $sector;
        $servant->update();
    }

    public function changeHierarchy($servant, $hierarchy)
    {
        $servant->hierarchy = $hierarchy;
        $servant->update();
    }

    public function addServants(Request $request, $id)
    {
        foreach ($request->servants as $new) {
            $servant = new Servant;
            $servant->person_id = $new;
            $servant->camp_id = $id;
            $servant->save();
        }
    }

    public function addServe(Request $request)
    {
        $serve = new Servant;
        $serve = $serve->where('person_id', $request->person_id)->where('camp_id', $request->camp_id)->first();

        if(!$serve){
            $serve = new Servant;
            $serve->person_id = $request->person_id;
            $serve->camp_id = $request->camp_id;
            $serve->sector = $request->sector;
            $serve->hierarchy = $request->hierarchy;
            $serve->save();
            return true;
        }else{
            return false;
        }
    }

    public function updateServe(Request $request)
    {
        $serve = Servant::where('person_id', $request->person_id)->where('camp_id', $request->camp_id)->first();

        if($serve){
            $serve->camp_id = $request->camp_id;
            $serve->sector = $request->sector;
            $serve->hierarchy = $request->hierarchy;
            $serve->update();
            return true;
        }else{
            return false;
        }
    }

    public function deleteServant($servant)
    {
        $servant->delete();
    }
}
