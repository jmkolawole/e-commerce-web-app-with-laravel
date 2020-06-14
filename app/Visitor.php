<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Visitor extends Authenticatable
{
    //

    use Notifiable;


    protected $fillable = ['first_name','last_name','email','password'];


    protected $hidden = ['password','remember_token'];
}
