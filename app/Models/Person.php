<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'contact',
        'street',
        'city',
        'state',
        'district',
        'number',
        'complement',
        'date_birthday',
        'email',
        'religion',
        'parish',
        'is_baptized',
        'is_confirmed',
        'is_eucharist',
        'is_married',
        'is_pastoral',
        'pastoral',
        'medical_attention',
        'reasons',
        'spouse_name',
        'is_spouse_camper',
        'image',
        'cpf',
        'marital_status'
    ];

    public function camps()
    {
        return $this->hasMany(Camper::class);
    }

    public function serves()
    {
        return $this->hasMany(Servant::class);
    }

    public function observations()
    {
        return $this->hasMany(Observation::class)->orderBy('created_at', 'desc');
    }
}
