<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // protected $with = ['salon','user'];

    function salon(){
        return $this->belongsTo(User::class, 'id' , 'salon_id' )->where('type', 'salon');
    }

    function user(){
        return $this->belongsTo(User::class, 'id' , 'user_id')->where('type', 'user');
    }

    function appointment(){
        return $this->belongsTo(Appointment::class,'appointment_id','id');
    }
}
