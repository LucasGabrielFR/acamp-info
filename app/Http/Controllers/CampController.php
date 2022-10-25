<?php

namespace App\Http\Controllers;

use App\Repositories\CampRepository;
use Illuminate\Http\Request;

class CampController extends Controller
{
    protected $repository;

    public function __construct(CampRepository $campRepository)
    {
        $this->repository = $campRepository;
    }

    public function index()
    {
        $camps = $this->repository->getAllCamps();
        return view('admin.pages.camp.index', [
            'camps' => $camps
        ]);
    }

    public function create()
    {
        $types = $this->repository->getAllTypes();

        return view(
            'admin.pages.camp.create',
            [
                "types" => $types,
            ]
        );
    }

    public function store(Request $request)
    {
        $this->repository->storeCamp($request);
        return redirect()->route('camp.index');
    }

    public function view($id)
    {
        $camp = $this->repository->getCamp($id);
        $campers = $this->repository->getCampers($id);
        if(!$camp)
            return redirect()->back();

        return view('admin.pages.camp.view', [
            'camp' => $camp,
            'campers' => $campers
        ]);
    }

    public function edit($id)
    {
        $camp = $this->repository->getCamp($id);
        $types = $this->repository->getAllTypes();

        if(!$camp)
            return redirect()->back();

        return view('admin.pages.camp.edit', [
            'camp' => $camp,
            'types' => $types
        ]);
    }

    public function update(Request $request, $id)
    {
        $camp = $this->repository->getCamp($id);
        if(!$camp)
            return redirect()->back();

        $this->repository->updateCamp($camp, $request->all());

        return redirect()->route('camp.index');
    }

    public function delete($id)
    {
        $type = $this->repository->getCamp($id);
        if(!$type)
            return redirect()->back();

        $this->repository->deleteCamp($type);

        return redirect()->route('camp.index');
    }

    public function noCampers($id)
    {
        $noCampers = $this->repository->getNoCampers($id);

        return response()->json($noCampers);
    }

    public function noCampersSearch(Request $request, $id)
    {
        $noCampers = $this->repository->getNoCampersSearch($request,$id);

        return response()->json($noCampers);
    }

    public function addCampers(Request $request, $id)
    {
        $this->repository->addCampers($request, $id);
    }

    public function deleteCamper($id)
    {
        $camper = $this->repository->getCamper($id);

        $this->repository->deleteCamper($camper);
        return redirect()->back();
    }

    public function changeGroup(Request $request)
    {
        $camper = $this->repository->getCamper($request->camper_id);

        $this->repository->changeGroup($camper, $request->group);
    }
}
