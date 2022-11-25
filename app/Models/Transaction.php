<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    // protected $table = 'transaction_type';

    protected $fillable = [
        'detail_distribution_id',
        'gas_station_id',
        'petrol_id',
        'status'
    ];
    public function log()
    {
        return $this->belongsTo(Log::class);
    }

    public function detail_distribution()
    {
        return $this->belongsTo(DetailDistribution::class);
    }

    public function petrol()
    {
        return $this->belongsTo(Petrol::class);
    }

    public function gas_station()
    {
        return $this->belongsTo(GasStation::class);
    }

}
