<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip',
        'name',
        'position_id',
        'business_unit_id',
        'phone_number',
        'detail_vehicle_id',
        'user_id',
    ];
    public function position()
        {
            return $this->belongsTo(Position::class);
        }

    public function business_unit()
        {
            return $this->belongsTo(BusinessUnit::class);
        }

    public function detail_vehicle()
        {
            return $this->belongsTo(DetailVehicle::class);
        }

    public function user()
        {
            return $this->belongsTo(User::class);
        }


}
