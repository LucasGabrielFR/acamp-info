<?php

namespace App\Repositories;

use App\Models\AcampType;
use App\Models\Camp;
use Illuminate\Http\Request;

class CampRepository
{
    protected $entity;

    public function __construct(Camp $model)
    {
        $this->entity = $model;
    }

    public function getAllCamps()
    {
        return $this->entity->orderBy('name')->paginate();
    }

    public function storeCamp(Request $request)
    {
        $this->entity->create($request->all());
    }

    public function getCamp($id)
    {
        $camp = $this->entity->where('id', $id)->first();

        return $camp;
    }

    public function updateCamp($camp, $data)
    {
        $camp->update($data);
    }

    public function deleteCamp($camp)
    {
        $camp->delete();
    }

    public function getAllTypes()
    {
        return AcampType::all();
    }

}
