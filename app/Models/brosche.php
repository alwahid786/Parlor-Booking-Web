<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brosche extends Model
{
    use HasFactory;

    function salon(){
        return $this->belongsTo(User::class,  'user_id','id')->where('type', 'salon');
    }
}
