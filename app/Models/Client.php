<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{
use HasApiTokens;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'email', 'address', 'longitude', 'attitude', 'password');

    public function helps()
    {
        return $this->hasMany('App\Models\Help');
    }

}