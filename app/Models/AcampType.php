<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcampType extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'min_age',
        'max_age',
        'order'
    ];

    public function camp()
    {
        return $this->hasOne(Camp::class);
    }
}
