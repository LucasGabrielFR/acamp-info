<?php

namespace App\Http\Controllers;

use App\Repositories\ForayRepository;
use Illuminate\Http\Request;

class ForayController extends Controller
{
    protected $repository;

    public function __construct(ForayRepository $forayRepository)
    {
        $this->repository = $forayRepository;
    }

    public function index()
    {
        $forays = $this->repository->getAllForays();
        return view('admin.pages.foray.index', [
            'forays' => $forays
        ]);
    }

    public function create()
    {
        return view('admin.pages.foray.create');
    }

    public function store(Request $request)
    {
        $this->repository->storeForay($request);
        return redirect()->route('forays.index');
    }

    public function view($id)
    {
        $foray = $this->repository->getForay($id);
        if (!$foray)
            return redirect()->back();

        return view('admin.pages.foray.view', [
            "foray" => $foray
        ]);
    }

    public function edit($id)
    {
        $foray = $this->repository->getForay($id);
        if (!$foray)
            return redirect()->back();

        return view('admin.pages.foray.edit', [
            "foray" => $foray
        ]);
    }

    public function update(Request $request, $id)
    {
        $foray = $this->repository->getForay($id);
        if (!$foray)
            return redirect()->back();

        $this->repository->updateForay($foray,$request->all());

        return redirect()->route('forays.index');
    }

    public function delete($id)
    {
        $foray = $this->repository->getForay($id);
        if (!$foray)
            return redirect()->back();

        $this->repository->deleteForay($foray);

        return redirect()->route('forays.index');
    }
}
