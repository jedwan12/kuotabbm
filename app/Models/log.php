<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_type_id',
        'quota',
        'gas_station_id',
        'detail_vehicle_id',

    ];
    public function transaction_type()
        {
            return $this->belongsTo(TransactionType::class);
        }

    public function gas_station()
        {
            return $this->belongsTo(GasStation::class);
        }

    public function detail_vehicle()
        {
            return $this->belongsTo(DetailVehicle::class);
        }
}
