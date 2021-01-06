<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'last_name', 'userable_type', 'userable_id','pesel', 
        'phone_number', 'city', 'post_code', 'street', 'street_number',
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

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function userable() {
        return $this->morphTo();
    }
    
    public function getIsDoctorAttribute() {
        return $this->userable_type == Doctor::class;
    }

    public function getIsEmployeeAttribute() {
        return $this->userable_type == Employee::class;
    }

    public function getIsActiveEmployeeAttribute() {
        return $this->isEmployee && $this->is_panel_active;
    }

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
