<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory,softDeletes;

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
        return $this->belongsTo(User::class);
    }
}
