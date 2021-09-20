<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    function salon(){
        return $this->hasOne(User::class, 'salon_id','id')->where('type', 'salon');
    }

}
