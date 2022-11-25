<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petrol extends Model
{
    use HasFactory;
    // protected $table = 'petrol';
    protected $fillable = [
        'type',
    ];

    public function detailvehicle()
    {
        return $this->hasMany(DetailVehicle::class);
    }
    public function transaction()
        {
            return $this->hasOne(Transaction::class);
        }
}

