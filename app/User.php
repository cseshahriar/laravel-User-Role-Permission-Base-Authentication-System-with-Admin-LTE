<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'name', 'email', 'password', 'designation', 
        'education', 'skills', 'image', 'mobile', 'phone', 'address', 'bio', 'provider', 'provider_id' 
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

    /**
     * Every user has many roles 
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class); 
    }

    /**
     * Every user has many permissions
     *
     * @return void
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);  
    }
}
