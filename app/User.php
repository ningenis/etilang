<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function violations()
    {
        return $this->hasMany(Violation::class, 'officer_id');
    }
    public function stations()
    {
        return $this->belongsToMany(Station::class, 'station_user');
    }
    public function perans()
    {
        return $this->belongsToMany(Peran::class, 'user_perans');
    }
    public function hasRole($role)
    {
        $role = $this->roles()->where('name', $role)->first();
        if (is_null($role)) {
            return false;
        }
        return true;
    }
}
