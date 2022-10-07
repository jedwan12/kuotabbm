<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_name',
        'vehicle_type_id',
        'plat_number',
        'business_unit_id',
        'petrol_id',
        'quota',
        'user_id',
    ];
    public function petrol()
        {
            return $this->belongsTo(Petrol::class);
        }

    public function vehicle_type()
        {
            return $this->belongsTo(VehicleType::class);
        }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business_unit()
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function transaction_type()
        {
            return $this->belongsTo(TransactionType::class);
        }

    public function log()
        {
            return $this->hasMany(Log::class);
        }

    public function request_quota()
        {
            return $this->hasMany(RequestQuota::class);
        }

}
