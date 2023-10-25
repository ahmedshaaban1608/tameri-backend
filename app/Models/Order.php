<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function tourguide(){
        return $this->belongsTo(Tourguide::class);
    }
    function tourist(){
        return $this->belongsTo(Tourist::class);
    }
}
