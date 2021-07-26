<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    use HasFactory; 
    
    function appointments(){
        return $this->hasMany(Appointment::class, 'id' , 'appointment_id');
    }
    function services(){
        return $this->hasOne(Service::class, 'id' , 'service_id');
    }
}
