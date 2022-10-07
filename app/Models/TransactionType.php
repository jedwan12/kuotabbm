<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;
    // protected $table = 'transaction_type';

    protected $fillable = [
        'type',
    ];
    public function log()
    {
        return $this->hasMany(Log::class);
    }

}
