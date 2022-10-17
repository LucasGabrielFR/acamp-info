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
        return $this->entity->orderBy('name')->paginate();
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

}
