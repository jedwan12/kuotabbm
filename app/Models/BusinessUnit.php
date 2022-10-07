<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;
    // protected $table = 'business_unit';
    protected $fillable = [
        'name',
    ];

    public function detailvehicle()
    {
        return $this->hasMany(DetailVehicle::class);
    }

    public function detailuser()
    {
        return $this->hasMany(DetailUser::class);
    }
}
