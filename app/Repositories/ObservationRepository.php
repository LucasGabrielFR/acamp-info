<?php

namespace App\Repositories;

use App\Models\Observation;
use Illuminate\Http\Request;

class ObservationRepository
{
    protected $entity;

    public function __construct(Observation $model)
    {
        $this->entity = $model;
    }

    public function storeObservation(Request $request)
    {
        return $this->entity->create($request->all());
    }
}
