<?php

namespace App\Http\Controllers;

use App\Repositories\ObservationRepository;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    protected $repository;

    public function __construct(ObservationRepository $observationRepository)
    {
        $this->repository = $observationRepository;
    }

    public function store(Request $request)
    {
        $observation = $this->repository->storeObservation($request);
        return [$observation, $observation->camp];
    }
}
