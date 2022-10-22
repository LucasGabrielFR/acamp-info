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
        return view('admin.pages.camp.types.create');
    }

    // public function store(Request $request)
    // {
    //     $this->repository->storeCamp($request);
    //     return redirect()->route('acamp-type.index');
    // }

    // public function view($id)
    // {
    //     $type = $this->repository->getCamp($id);
    //     if(!$type)
    //         return redirect()->back();

    //     return view('admin.pages.camp.types.view', [
    //         'type' => $type,
    //     ]);
    // }

    // public function edit($id)
    // {
    //     $type = $this->repository->getCamp($id);
    //     if(!$type)
    //         return redirect()->back();

    //     return view('admin.pages.camp.types.edit', [
    //         'type' => $type,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $type = $this->repository->getCamp($id);
    //     if(!$type)
    //         return redirect()->back();

    //     $this->repository->updateCamp($type, $request->all());

    //     return redirect()->route('acamp-type.index');
    // }

    // public function delete($id)
    // {
    //     $type = $this->repository->getCamp($id);
    //     if(!$type)
    //         return redirect()->back();

    //     $this->repository->deleteCamp($type);

    //     return redirect()->route('acamp-type.index');
    // }
}
