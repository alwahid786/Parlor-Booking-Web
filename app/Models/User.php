<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes,HasApiTokens;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'phone_code',
        'phone_number',
        'phone_verified_at',
        'is_social',
        'social_id',
        'social_email',
        'social_type',
        'password',
        'gender',
        'is_online',
        'type',
        'long',
        'lat',
        'address',
        'start_time',
        'end_time',
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    Protected $with = [
        // 'media',
        'offer'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function salon(){
        return $this->hasMany($this)->where('type', 'salon');
    }

    function user(){
        return $this->hasMany($this)->where('type', 'user');
    }

    function days(){
        return $this->hasMany(Day::class,  'salon_id','id');
    }

    function appointments(){
        return $this->hasMany(Appointment::class, 'salon_id','id');
    }

    function offer(){
        return $this->hasOne(Offer::class, 'salon_id','id')->where('status','active');
    }

    function offers(){
        return $this->hasMany(Offer::class, 'salon_id','id');
    }
    function media(){
        return $this->hasMany(Media::class, 'user_id','id');
    }

    function brosche(){
        return $this->hasMany(brosche::class, 'user_id','id');
    }

    function services(){
        return $this->hasMany(Service::class, 'salon_id','id');
    }
}
