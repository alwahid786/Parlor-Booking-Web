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
        'state'
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

    public function getDayAttribute(){

        return Carbon::parse($this->date)->format('l');
    }
    public function getStateAttribute(){

        if(Carbon::now() == Carbon::parse($this->date))
            $msg = "Today";
        if(Carbon::tomorrow() == Carbon::parse($this->date))
            $msg = "Tomorrow";
        if(Carbon::tomorrow() == Carbon::parse($this->date))
            $msg = "Tomorrow";

    }
}
