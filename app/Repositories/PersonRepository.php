<?php

namespace App\Repositories;

use App\Models\Person;

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
}
