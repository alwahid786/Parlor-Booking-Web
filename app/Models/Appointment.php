<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,softDeletes;

    protected $table = 'appointments';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [];
    protected $appends = [
        'day',
        'state',
        'rating'
    ];

    protected $with = [
        'appointmentDetails'
    ];

    function salon(){
        return $this->hasOne(User::class, 'id' , 'salon_id' )->where('type', 'salon');
    }
    function user(){
        return $this->hasOne(User::class, 'id' , 'user_id')->where('type', 'user');
    }
    function appointmentDetails(){
        return $this->hasMany(AppointmentDetail::class, 'appointment_id', 'id');
    }
    function review(){
        return $this->hasOne(Review::class,'appointment_id','id');
    }


    public function getDayAttribute(){
        // return $this->date;
        // return date('D', strtotime($this->date));
        return Carbon::parse($this->date)->format('l');
    }

    public function getRatingAttribute(){
        return $this->review->rating ?? 0;
    }

    public function getStateAttribute(){

        if(Carbon::now() == Carbon::parse($this->date))
            $msg = "Today";
        if(Carbon::tomorrow() == Carbon::parse($this->date))
            $msg = "Tomorrow";
        else
            $msg = Carbon::parse($this->date)->format('Y-m-d');

        return $msg;

    }
}
