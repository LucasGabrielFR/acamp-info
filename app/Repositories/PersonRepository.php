<?php

namespace App\Repositories;

use App\Models\Person;
use Illuminate\Http\Request;

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

    public function storePerson(Request $request)
    {
        $this->entity->create($request->all());
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
        $person->update($data);
    }

    public function getPersonCamps($id)
    {
        return $this->entity->select(
            't.name as type_name',
            'c.name as camp_name',
            'c.date_start',
            'c.date_end',
            'ca.group'
        )
        ->join('campers as ca', 'ca.person_id', '=', 'people.id')
        ->join('camps as c', 'c.id', '=', 'ca.camp_id')
        ->join('acamp_types as t', 't.id', '=', 'c.type_id')
        ->where('people.id', $id)
        ->get();
    }

}
