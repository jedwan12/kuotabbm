<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_type_id',
        'management_type_id',
        'quota',
        'gas_station_id',
        'detail_distribution_id',
        'note',
        'updated_by',
        // 'detail_vehicle_id',

    ];
    public function transaction_type()
        {
            return $this->belongsTo(TransactionType::class);
        }

    public function management_type()
        {
            return $this->belongsTo(ManagementType::class);
        }

    public function gas_station()
        {
            return $this->belongsTo(GasStation::class);
        }

    public function detail_distribution()
        {
            return $this->belongsTo(DetailDistribution::class);
        }

    public function transaction()
        {
            return $this->hasOne(Transaction::class);
        }

    // public function detail_vehicle()
    //     {
    //         return $this->belongsTo(DetailVehicle::class);
    //     }
}
