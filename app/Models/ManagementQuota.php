<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementQuota extends Model
{
    use HasFactory;
    protected $fillable = [
        'quota',
        'detail_distribution_id',
        'note',
        'updated_by',
    ];

    public function detail_distribution()
    {
        return $this->belongsTo(DetailDistribution::class);
    }

    public function log()
        {
            return $this->hasMany(Log::class);
        }
}
