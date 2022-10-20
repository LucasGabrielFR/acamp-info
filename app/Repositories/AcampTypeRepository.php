<?php

namespace App\Repositories;

use App\Models\AcampType;
use Illuminate\Http\Request;

class AcampTypeRepository
{
    protected $entity;

    public function __construct(AcampType $model)
    {
        $this->entity = $model;
    }

    public function getAllTypes()
    {
        return $this->entity->orderBy('min_age')->paginate();
    }

    public function storeType(Request $request)
    {
        $this->entity->create($request->all());
    }

    public function getType($id)
    {
        $type = $this->entity->where('id', $id)->first();

        return $type;
    }

    public function updateType($type, $data)
    {
        $type->update($data);
    }

    public function deleteType($type)
    {
        $type->delete();
    }

}
