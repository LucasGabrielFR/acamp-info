<?php

namespace App\Http\Controllers;

use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    protected $repository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->repository = $personRepository;
    }

    public function index()
    {
        $people = $this->repository->getAllPeople();
        return view('admin.pages.people.index', [
            'people' => $people
        ]);
    }
}
