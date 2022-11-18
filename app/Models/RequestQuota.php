<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestQuota extends Model
{
    use HasFactory;
    protected $table = 'request_quota';
    protected $fillable = [
        'total_request',
        'approval',
        'note',
        'user_id',
        'detail_distribution_id'
        // 'detail_vehicle_id',
    ];

    public function detail_distribution()
    {
        return $this->belongsTo(DetailDistribution::class);
    }

    // public function detail_vehicle()
    //     {
    //         return $this->belongsTo(DetailVehicle::class);
    //     }

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
