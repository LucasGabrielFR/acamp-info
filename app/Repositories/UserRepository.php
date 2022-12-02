<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    protected $entity;

    public function __construct(User $model)
    {
        $this->entity = $model;
    }

    public function storeUser(User $user)
    {
        $user->save();
    }

    public function updateUser($user, $data)
    {
        $user->update($data);
    }

    public function deleteUser($user)
    {
        $user->delete();
    }

    public function verifyUser($personId)
    {
        return $this->entity->where('person_id', $personId)->get();
    }

}
