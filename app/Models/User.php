<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_active',
        'is_ldap',
        'role_id',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function detailuser()
    {
        return $this->hasOne(DetailUser::class);
    }

    public function log()
    {
        return $this->hasMany(Log::class);
    }

    public function requestquota()
    {
        return $this->hasMany(RequestQuota::class);
    }

    public function detailvehicle()
        {
            return $this->hasOne(DetailVehicle::class);
        }

    public function gasstation()
        {
            return $this->hasOne(GasStation::class);
        }

    public function role()
        {
            return $this->belongsTo(Role::class);
        }

}
