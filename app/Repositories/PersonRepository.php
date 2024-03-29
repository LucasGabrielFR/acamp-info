<?php

namespace App\Repositories;

use App\Models\Observation;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonRepository
{
    protected $entity;

    public function __construct(Person $model)
    {
        $this->entity = $model;
    }

    public function getAllPeople()
    {
        return $this->entity->orderBy('name')->get();
    }

    public function getNoCampers()
    {
        $people = $this->entity
            ->whereDoesntHave('camps')
            ->whereDoesntHave('serves')
            ->orWhere('is_waiting', '=', '1')
            ->get();
        return $people;
    }

    public function getAllCampers()
    {
        $campers = $this->entity
            ->whereIn('id', DB::table('campers')->select('person_id'))
            ->get();
        return $campers;
    }

    public function storePerson($data)
    {
        if (!$this->verifyCpf($data["cpf"])) {
            $person = $this->entity->create($data);
            return [true, $person];
        }
        return [false];
    }

    public function getPerson($id)
    {
        $person = $this->entity->where('id', $id)->first();
        return $person;
    }

    public function deletePerson($person)
    {
        $person->delete();
    }

    public function updatePerson($person, $data)
    {
        if (!isset($data["medical_attention"])) {
            $data["medical_attention"] = null;
        }
        if ($person->cpf === $data["cpf"]) {
            $person->update($data);
            return [true, $person];
        }
        if (!$this->verifyCpf($data["cpf"])) {
            $person->update($data);
            return [true, $person];
        }
        return [false];
    }

    public function getPersonCamps($id)
    {
        return $this->entity->select(
            't.name as type_name',
            'c.name as camp_name',
            'c.date_start',
            'c.date_end',
            'ca.group',
            'ca.id as camper_id'
        )
            ->join('campers as ca', 'ca.person_id', '=', 'people.id')
            ->join('camps as c', 'c.id', '=', 'ca.camp_id')
            ->join('acamp_types as t', 't.id', '=', 'c.type_id')
            ->where('people.id', $id)
            ->orderBy('c.date_end', 'desc')
            ->get();
    }

    public function getMaxCamp($id)
    {
        return $this->entity->select(
            DB::raw('MAX(t.order) as max')
        )
            ->join('campers as ca', 'ca.person_id', '=', 'people.id')
            ->join('camps as c', 'c.id', '=', 'ca.camp_id')
            ->join('acamp_types as t', 't.id', '=', 'c.type_id')
            ->where('people.id', $id)
            ->orderBy('c.date_end', 'desc')
            ->first();
    }

    public function getPersonServers($id)
    {
        return $this->entity->select(
            't.name as type_name',
            'c.name as camp_name',
            's.id as servant_id',
            'c.date_start',
            'c.date_end',
            's.sector',
            's.hierarchy'
        )
            ->join('servants as s', 's.person_id', '=', 'people.id')
            ->join('camps as c', 'c.id', '=', 's.camp_id')
            ->join('acamp_types as t', 't.id', '=', 'c.type_id')
            ->where('people.id', $id)
            ->orderBy('c.date_end', 'desc')
            ->get();
    }

    public function getPersonObservations($id)
    {
        return Observation::where('person_id', $id)->get();
    }

    public function verifyCpf($cpf)
    {
        $verify = $this->entity->where('cpf', $cpf)->first();
        if ($verify) {
            return true;
        }
        return false;
    }
}
