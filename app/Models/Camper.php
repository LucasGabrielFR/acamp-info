<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camper extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'camp_id',
        'person_id',
        'shirt_size',
        'group',
    ];

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    public function camp()
    {
        return $this->hasOne(Camp::class, 'id', 'camp_id');
    }
}
