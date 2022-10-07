<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasStation extends Model
{
    use HasFactory;
    // protected $table = 'gas_station';
    protected $fillable = [
        'name_pt',
        'location',
    ];

    public function log()
    {
        return $this->hasMany(Log::class);
    }
}
