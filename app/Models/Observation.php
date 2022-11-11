<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'type',
        'person_id',
        'observation',
        'camp_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function camp()
    {
        return $this->hasOne(Camp::class, 'id', 'camp_id');
    }

}
