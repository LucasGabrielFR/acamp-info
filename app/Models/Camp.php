<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'informations',
        'date_start',
        'date_end',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo(AcampType::class);
    }

    public function campers()
    {
        return $this->belongsTo(Camper::class);
    }

    public function servants()
    {
        return $this->belongsTo(Servant::class);
    }

    public function observations()
    {
        return $this->belongsTo(Observation::class);
    }
}
