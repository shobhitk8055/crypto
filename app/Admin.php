<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function orders(){
        return $this->hasMany(orders::class);
    }

    public function funds(){
        return $this->hasMany(Fund::class);
    }

    public function transfers(){
        return $this->hasMany(Transfer::class);
    }
    public function team(){
        return $this->hasMany(Team::class);
    }
    public function accounts(){
        return $this->hasMany(Accounts::class);
    }
    public function withdrawls(){
        return $this->hasMany(Withdrawls::class);
    }
}
