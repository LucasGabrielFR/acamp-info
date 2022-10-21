<?php

namespace App\Repositories;

use App\Models\Foray;
use Illuminate\Http\Request;

class ForayRepository
{
    protected $entity;

    public function __construct(Foray $model)
    {
        $this->entity = $model;
    }

    public function getAllForays()
    {
        return $this->entity->orderBy('name')->paginate();
    }

    public function storeForay(Request $request)
    {
        $this->entity->create($request->all());
    }

    public function getForay($id)
    {
        $foray = $this->entity->where('id', $id)->first();

        return $foray;
    }

    public function updateForay($foray, $data)
    {
        $foray->update($data);
    }

    public function deleteForay($foray)
    {
        $foray->delete();
    }

}
