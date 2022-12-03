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
        $servants = $this->repository->getServants($id);
        if(!$camp)
            return redirect()->back();

        return view('admin.pages.camp.view', [
            'camp' => $camp,
            'campers' => $campers,
            'servants' => $servants
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

    public function addCamper(Request $request)
    {
        if($this->repository->addCamper($request)){
            return response('Inscrição feita!', 200);
        }
        return response('Campista já está inscrito neste acampamento!',400);
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

    public function noServants($id)
    {
        $camp = $this->repository->getCamp($id);
        if($camp->type->order == 3){
            $noServants = $this->repository->getNoServantsForSenior($id);
        }else{
            $noServants = $this->repository->getNoServantsForFac($id);
        }

        return response()->json($noServants);
    }

    public function noServantsSearch(Request $request, $id)
    {
        $camp = $this->repository->getCamp($id);
        if($camp->type->order == 3){
            $noServants = $this->repository->getNoServantsForSeniorSearch($request, $id);
        }else{
            $noServants = $this->repository->getNoServantsForFacSearch($request, $id);
        }

        return response()->json($noServants);
    }

    public function addServants(Request $request, $id)
    {
        $this->repository->addServants($request, $id);
    }

    public function addServe(Request $request)
    {
        if($this->repository->addServe($request)){
            return response('Inscrição feita!', 200);
        }
        return response('Servo já está inscrito neste acampamento!',400);
    }

    public function updateServe(Request $request)
    {
        if($this->repository->updateServe($request)){
            return response('Inscrição Atualizada!', 200);
        }
        return response('Servo já está inscrito neste acampamento!',400);
    }

    public function deleteServant($id)
    {
        $servant = $this->repository->getServant($id);

        $this->repository->deleteServant($servant);
        return redirect()->back();
    }

    public function changeSector(Request $request)
    {
        $servant = $this->repository->getServant($request->servant_id);

        $this->repository->changeSector($servant, $request->sector);
    }

    public function changeHierarchy(Request $request)
    {
        $servant = $this->repository->getServant($request->servant_id);

        $this->repository->changeHierarchy($servant, $request->hierarchy);
    }

    public function getServant(Request $request)
    {
        $servant = $this->repository->getServant($request->servant_id);
        return $servant;
    }

    public function getCamper(Request $request)
    {
        $camper = $this->repository->getCamper($request->camper_id);
        return $camper;
    }

    public function updateCamper(Request $request)
    {
        if($this->repository->updateCamper($request)){
            return response('Inscrição Atualizada!', 200);
        }
        return response('Servo já está inscrito neste acampamento!',400);
    }
}
