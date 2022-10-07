<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
    ];

    public function detail_vehicle()
    {
        return $this->hasMany(DetailVehicle::class);
    }
}
