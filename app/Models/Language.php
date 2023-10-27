<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ["tourguide_id", "language"];



    function tourguide(){
        return $this->belongsTo(Tourguide::class);
    }
}
