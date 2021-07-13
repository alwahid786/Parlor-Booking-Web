<?php

namespace App\Models;

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

    protected $fillable = [

    ];

    function salon(){
        return $this->hasOne(User::class, 'id' , 'salon_id' )->where('type', 'salon');
    }

    function user(){
        return $this->hasOne(User::class, 'id' , 'user_id')->where('type', 'user');
    }
}
