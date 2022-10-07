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
        'approval1',
        'approval2',
        'user_id',
        'detail_vehicle_id',
    ];

    public function detail_vehicle()
        {
            return $this->belongsTo(DetailVehicle::class);
        }

    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
