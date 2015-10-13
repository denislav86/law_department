<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    const STATUS_PENDING = 'pending';

    const STATUS_REJECTED = 'rejected';

    const STATUS_APPROVED = 'approved';

    protected $fillable = ['citizen_id','lawyer_id', 'appointment_datetime','status','created_at','updated_at'];

    public function citizen()
    {
        return $this->belongsTo('App\Models\Citizen');
    }

    public function lawyer()
    {
        return $this->belongsTo('App\Models\Lawyer');
    }


}