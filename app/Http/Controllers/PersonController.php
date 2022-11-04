<?php

namespace App\Http\Controllers;

use App\Repositories\PersonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    protected $repository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->repository = $personRepository;
    }

    public function index()
    {
        $people = $this->repository->getNoCampers();

        return view('admin.pages.people.index', [
            'people' => $people,
            'type' => 'noCampers'
        ]);
    }

    public function campers()
    {
        $people = $this->repository->getAllCampers();
        foreach ($people as $person) {
            $person->markers = $this->repository->getPersonCamps($person->id);
            $person->servers = $this->repository->getPersonServers($person->id);
        }

        return view('admin.pages.people.index', [
            'people' => $people,
            'type' => 'campers'
        ]);
    }

    public function create()
    {
        return view('admin.pages.people.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('people', ['disk' => 'custom_uploads']);

            $data['image'] = $imagePath;
        }
        $this->repository->storePerson($data);
        return redirect()->route('people.index');
    }

    public function view($id)
    {
        $person = $this->repository->getPerson($id);
        $person->markers = $this->repository->getPersonCamps($person->id);
        $person->servers = $this->repository->getPersonServers($person->id);

        if (!$person)
            return redirect()->back();

        return view('admin.pages.people.view', [
            'person' => $person,
        ]);
    }

    public function delete($id)
    {
        $person = $this->repository->getPerson($id);
        if (!$person)
            return redirect()->back();

        if($person->image){
            if (Storage::disk('custom_uploads')->exists($person->image)) {
                Storage::disk('custom_uploads')->delete($person->image);
            }
        }

        $this->repository->deletePerson($person);

        return redirect()->route('people.index');
    }

    public function edit($id)
    {
        $person = $this->repository->getPerson($id);
        if (!$person)
            return redirect()->back();

        return view('admin.pages.people.edit', [
            'person' => $person,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $person = $this->repository->getPerson($id);
        if (!$person)
            return redirect()->back();

        if ($request->hasFile('image')) {

            if($person->image){
                if (Storage::disk('custom_uploads')->exists($person->image)) {
                    Storage::disk('custom_uploads')->delete($person->image);
                }
            }

            $imagePath = $request->file('image')->store('people', ['disk' => 'custom_uploads']);
            $data['image'] = $imagePath;
        }

        $this->repository->updatePerson($person, $data);

        return redirect()->route('people.index');
    }
}
