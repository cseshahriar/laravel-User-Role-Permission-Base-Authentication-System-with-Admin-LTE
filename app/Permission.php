<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];

    /**
     * Every permission has many users
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);   
    }
}
