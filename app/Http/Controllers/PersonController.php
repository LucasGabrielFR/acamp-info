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
        foreach($people as $person){
            $person->markers = $this->repository->getPersonCamps($person->id);
        }
        return view('admin.pages.people.index', [
            'people' => $people
        ]);
    }

    public function create()
    {
        return view('admin.pages.people.create');
    }

    public function store(Request $request)
    {
        $this->repository->storePerson($request);
        return redirect()->route('people.index');
    }

    public function view($id)
    {
        $person = $this->repository->getPerson($id);
        if(!$person)
            return redirect()->back();

        return view('admin.pages.people.view', [
            'person' => $person,
        ]);
    }

    public function delete($id)
    {
        $person = $this->repository->getPerson($id);
        if(!$person)
            return redirect()->back();

        $this->repository->deletePerson($person);

        return redirect()->route('people.index');
    }

    public function edit($id)
    {
        $person = $this->repository->getPerson($id);
        if(!$person)
            return redirect()->back();

        return view('admin.pages.people.edit', [
            'person' => $person,
        ]);
    }

    public function update(Request $request, $id)
    {
        $person = $this->repository->getPerson($id);
        if(!$person)
            return redirect()->back();

        $this->repository->updatePerson($person, $request->all());

        return redirect()->route('people.index');
    }
}
