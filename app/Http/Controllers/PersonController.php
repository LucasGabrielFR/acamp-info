<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Repositories\CampRepository;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function online()
    {
        return view('online.form.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('people', ['disk' => 'custom_uploads']);

            $data['image'] = $imagePath;
        }
        if ($this->repository->storePerson($data)) {
            toastr()->success('Pré-Ficha Criada com sucesso!');

            return redirect()->route('people.index');
        }

        toastr()->error('Este CPF já esta cadastrado!');

        return back();
    }

    public function view($id)
    {
        $person = $this->repository->getPerson($id);
        $campRepository = new CampRepository(new Camp());
        $camps = $campRepository->getAllCamps();
        $maior = 0;
        foreach ($camps as $camp) {
            if ($camp->type->order > $maior) {
                $maior = $camp->type->order;
            }
        }
        if (!$person)
            return redirect()->back();

        return view('admin.pages.people.view', [
            'person' => $person,
            'camps' => $camps,
        ]);
    }

    public function delete($id)
    {
        $person = $this->repository->getPerson($id);
        if (!$person)
            return redirect()->back();

        if ($person->image) {
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

            if ($person->image) {
                if (Storage::disk('custom_uploads')->exists($person->image)) {
                    Storage::disk('custom_uploads')->delete($person->image);
                }
            }

            $imagePath = $request->file('image')->store('people', ['disk' => 'custom_uploads']);
            $data['image'] = $imagePath;
        }

        if ($this->repository->updatePerson($person, $data)) {
            toastr()->success('Cadastro salvo com sucesso!');

            return redirect()->route('people.index');
        }

        toastr()->error('Este CPF já esta cadastrado!');

        return back();
    }

    public function personal()
    {
        $user = Auth::user();
        $id = $user->person_id;
        $person = $this->repository->getPerson($id);
        $campRepository = new CampRepository(new Camp());
        $camps = $campRepository->getAllCamps();
        $maior = 0;
        foreach ($camps as $camp) {
            if ($camp->type->order > $maior) {
                $maior = $camp->type->order;
            }
        }

        return view('admin.pages.person.view', [
            'person' => $person,
            'camps' => $camps,
        ]);
    }

    public function personalEdit()
    {
        $user = Auth::user();
        $id = $user->person_id;
        $person = $this->repository->getPerson($id);

        return view('admin.pages.person.edit', [
            'person' => $person,
        ]);
    }

    public function personalUpdate(Request $request, $id)
    {
        $data = $request->all();
        $person = $this->repository->getPerson($id);
        if (!$person)
            return redirect()->back();

        if ($request->hasFile('image')) {

            if ($person->image) {
                if (Storage::disk('custom_uploads')->exists($person->image)) {
                    Storage::disk('custom_uploads')->delete($person->image);
                }
            }

            $imagePath = $request->file('image')->store('people', ['disk' => 'custom_uploads']);
            $data['image'] = $imagePath;
        }

        if ($this->repository->updatePerson($person, $data)) {
            toastr()->success('Cadastro salvo com sucesso!');

            return redirect()->route('people.index');
        }

        toastr()->error('Este CPF já esta cadastrado!');

        return back();
    }
}
