<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;
  protected $fillable = [
        'name', 'email', 'password','gender','country','state',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function likes()
    {
        return $this->hasMany('App\Like');        
    }
    public function News()
    {
        return $this->hasMany('App\News');        
    }
}
