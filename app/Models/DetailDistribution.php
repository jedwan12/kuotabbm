<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDistribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'detail_vehicle_id',
        'distribution_id',
        'quota',

    ];
    // public function transaction_type()
    //     {
    //         return $this->belongsTo(TransactionType::class);
    //     }
    public function scopeUser($query , array $user){
        $query->when($user['user'] ?? false,function ($query,$filter){
            // return response()->json('test',200);
            return $query->where('detail_vehicles.user_id',$filter);
        });
    }
    public function detail_vehicle(){
        return $this->belongsTo(DetailVehicle::class);
    }

    public function distribution(){
        return $this->belongsTo(Distribution::class);
    }

    public function log()
        {
            return $this->hasMany(Log::class);
        }
    public function request_quota()
        {
            return $this->hasMany(RequestQuota::class);
        }
    public function qr()
        {
            return $this->hasOne(QR::class);
        }

    public function detail_distribution()
        {
            return $this->hasOne(DetailDistribution::class);
        }

        public function transaction()
        {
            return $this->hasOne(Transaction::class);
        }
}
