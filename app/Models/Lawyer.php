<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{

    protected $fillable = ['user_id','firstname', 'lastname' , 'created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }

}