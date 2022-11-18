<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
    ];

    public function log()
    {
        return $this->hasMany(Log::class);
    }
}
