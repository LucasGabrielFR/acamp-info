<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use App\Repositories\CampRepository;
use App\Repositories\PersonRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        foreach ($people as $key => $person) {
            $serves = $this->repository->getPersonServers($person->id);
            $camps = $this->repository->getPersonCamps($person->id);
            $people[$key]->serves = $serves;
            $people[$key]->camps = $camps;
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

        $familiares = $this->prepareFamilyData($data);

        $data['familiar'] = json_encode($familiares);

        $data['is_waiting'] = $this->getWaitingStatus($data['modality']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('people', ['disk' => 'custom_uploads']);

            $data['image'] = $imagePath;
        }
        $result = $this->repository->storePerson($data);

        if ($result[0]) {
            $userRepository = new UserRepository(new User());
            if (count($userRepository->verifyUser($result[1]->id)) < 1) {
                $username = $data['cpf'];
                $username = str_replace('.', '', $username);
                $username = str_replace('-', '', $username);

                $user = new User();
                $user->email = $username;
                $user->password = Hash::make($username);
                $user->name = $result[1]->name;
                $user->person_id = $result[1]->id;
                $user->acl = 2;
                $userRepository->storeUser($user);
            }

            toastr()->success('Pré-Ficha Criada com sucesso!');

            return redirect()->route('people.index');
        }

        toastr()->error('Este CPF já esta cadastrado!');

        return back();
    }

    public function view($id)
    {
        $person = $this->repository->getPerson($id);
        $serves = $this->repository->getPersonServers($id);
        $campers = $this->repository->getPersonCamps($id);
        $campRepository = new CampRepository(new Camp());
        $camps = $campRepository->getAllCamps();
        $user = Auth::user();

        if (!$person)
            return redirect()->back();

        return view('admin.pages.people.view', [
            'person' => $person,
            'camps' => $camps,
            'serves' => $serves,
            'campers' => $campers,
            'user' => $user
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
        $max = $this->repository->getMaxCamp($id);
        $person->max = $max->max;
        $user = Auth::user();
        if (!$person)
            return redirect()->back();

        return view('admin.pages.people.edit', [
            'person' => $person,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $familiares = $this->prepareFamilyData($data);

        $data['familiar'] = json_encode($familiares);

        $data['is_waiting'] = $this->getWaitingStatus($data['modality']);

        $person = $this->repository->getPerson($id);

        if ($person->modality != $data['modality'] && $data['modality'] != 9) {
            $data['waiting_date'] = date('Y-m-d H:i:s');
        }

        if ($data['modality'] != 9) {
            $data['waiting_date'] = null;
        }

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
        $result = $this->repository->updatePerson($person, $data);
        if ($result[0]) {

            $userRepository = new UserRepository(new User());
            if (count($userRepository->verifyUser($result[1]->id)) < 1) {
                $username = $data['cpf'];
                $username = str_replace('.', '', $username);
                $username = str_replace('-', '', $username);

                $user = new User();
                $user->email = $username;
                $user->password = Hash::make($username);
                $user->name = $result[1]->name;
                $user->person_id = $result[1]->id;
                $user->acl = 2;
                $userRepository->storeUser($user);
            }

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
        $serves = $this->repository->getPersonServers($id);
        $campers = $this->repository->getPersonCamps($id);

        return view('admin.pages.person.view', [
            'person' => $person,
            'camps' => $camps,
            'user' => $user,
            'serves' => $serves,
            'campers' => $campers
        ]);
    }

    public function personalEdit()
    {
        $user = Auth::user();
        $id = $user->person_id;
        $person = $this->repository->getPerson($id);
        $max = $this->repository->getMaxCamp($id);
        $person->max = $max->max;

        return view('admin.pages.person.edit', [
            'person' => $person,
        ]);
    }

    public function personalUpdate(Request $request, $id)
    {
        $data = $request->all();

        $familiares = $this->prepareFamilyData($data);

        $data['familiar'] = json_encode($familiares);

        $data['is_waiting'] = $this->getWaitingStatus($data['modality']);

        $person = $this->repository->getPerson($id);

        if ($person->modality != $data['modality'] && $data['modality'] != 9) {
            $data['waiting_date'] = date('Y-m-d H:i:s');
        }

        if ($data['modality'] != 9) {
            $data['waiting_date'] = null;
        }

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

    public function waitingList()
    {
        $waitingList = $this->repository->getNoCampers();

        return response()->json($waitingList);
    }

    public function campersList()
    {
        $campersList = $this->repository->getAllCampers();

        foreach ($campersList as $key => $person) {
            $serves = $this->repository->getPersonServers($person->id);
            $camps = $this->repository->getPersonCamps($person->id);
            $campersList[$key]->serves = $serves;
            $campersList[$key]->camps = $camps;
        }

        return response()->json($campersList);
    }

    //API ROUTES
    public function register(Request $request)
    {
        $data = $request->all();
        $data['is_waiting'] = 1;

        if (!$this->repository->verifyCpf($data['cpf'])) {
            // if ($data['ip'] == '189.4.78.61') {
            $result = $this->repository->storePerson($data);

            if ($result[0]) {
                $userRepository = new UserRepository(new User());
                if (count($userRepository->verifyUser($result[1]->id)) < 1) {
                    $username = $data['cpf'];
                    $username = str_replace('.', '', $username);
                    $username = str_replace('-', '', $username);

                    $user = new User();
                    $user->email = $username;
                    $user->password = Hash::make($username);
                    $user->name = $result[1]->name;
                    $user->person_id = $result[1]->id;
                    $user->acl = 2;
                    $userRepository->storeUser($user);
                }
            }

            return response(
                [
                    'status' => 200,
                    'message' => 'Pré Ficha enviada com sucesso'
                ],
                200
            );
            // }else{
            //     return response([
            //         'status' => 401,
            //         'message' => 'Ocorreu um problema e a pré-ficha não pôde ser enviada, tente novamente mais tarde ou entre em contato com os responsáveis.'
            //     ], 401);
            // }
        } else {
            return response([
                'status' => 203,
                'message' => 'Este CPF já foi cadastrado!'
            ], 203);
        }
    }

    private function prepareFamilyData(array $data)
    {
        $familiares = array();

        for ($i = 1; $i <= 3; $i++) {
            if (!empty($data["familiar_$i"]) || !empty($data["relationship_$i"])) {
                $familiares[$i] = [
                    "familiar" => $data["familiar_$i"],
                    "relationship" => $data["relationship_$i"]
                ];
            }
        }

        return $familiares;
    }

    private function getWaitingStatus(int $modality)
    {
        $valid_modalities = [0, 1, 2, 3, 4];

        return in_array($modality, $valid_modalities) ? 1 : 0;
    }
}
