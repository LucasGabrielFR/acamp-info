<?php

namespace App\Http\Controllers;

use App\Repositories\AcampTypeRepository;
use Illuminate\Http\Request;

class AcampTypeController extends Controller
{
    protected $repository;

    public function __construct(AcampTypeRepository $acampTypeRepository)
    {
        $this->repository = $acampTypeRepository;
    }

    public function index()
    {
        $types = $this->repository->getAllTypes();
        return view('admin.pages.camp.types.index', [
            'types' => $types
        ]);
    }

    public function create()
    {
        return view('admin.pages.camp.types.create');
    }

    public function store(Request $request)
    {
        $this->repository->storeType($request);
        return redirect()->route('acamp-type.index');
    }

    public function view($id)
    {
        $type = $this->repository->getType($id);
        if(!$type)
            return redirect()->back();

        return view('admin.pages.camp.types.view', [
            'type' => $type,
        ]);
    }

    public function edit($id)
    {
        $type = $this->repository->getType($id);
        if(!$type)
            return redirect()->back();

        return view('admin.pages.camp.types.edit', [
            'type' => $type,
        ]);
    }

    public function update(Request $request, $id)
    {
        $type = $this->repository->getType($id);
        if(!$type)
            return redirect()->back();

        $this->repository->updateType($type, $request->all());

        return redirect()->route('acamp-type.index');
    }

    public function delete($id)
    {
        $type = $this->repository->getType($id);
        if(!$type)
            return redirect()->back();

        $this->repository->deleteType($type);

        return redirect()->route('acamp-type.index');
    }
}
