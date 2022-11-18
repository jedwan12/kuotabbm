<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'startdate',
        'enddate',
        'total_quota',

    ];
    public function detail_distribution()
        {
            return $this->hasMany(DetailDistribution::class);
        }
}
