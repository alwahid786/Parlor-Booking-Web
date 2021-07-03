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
}
