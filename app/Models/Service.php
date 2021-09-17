<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory,softDeletes;

    // protected $appends = ['total_price'];

    protected $table = 'services';

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
    	'name',
		'price',
		'slot',
		'time',
    ];

    function salon(){
        return $this->belongsTo(User::class, 'salon_id', 'id');
    }

    function appointmentDetails(){
        return $this->hasMany(AppointmentDetail::class, 'service_id', 'id');
    }

    function offer(){
        return $this->hasOne(Offer::class, 'service_id', 'id')->where('status','active');
    }

}
