<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QR extends Model
{
    use HasFactory;
    protected $table = 'qr';
    protected $fillable = [
        'detail_distribution_id',

    ];
    public function detail_distribution()
        {
            return $this->belongsTo(DetailDistribution::class);
        }
}
