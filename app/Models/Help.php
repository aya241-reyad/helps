<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model 
{

    protected $table = 'helps';
    public $timestamps = true;
    protected $fillable = array('client_id', 'description', 'longitude', 'attitude');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}