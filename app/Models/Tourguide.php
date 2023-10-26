<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourguide extends Model
{
    use HasFactory;

    protected $fillable = [
 'id',        
'gender',
'birth_date',
'bio',
'description',
'avatar',
'profile_img',
'day_price',
'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function language(){
        return $this->hasMany(Language::class);
    }
    function area(){
        return $this->hasMany(Area::class);
    }
    function review(){
        return $this->hasMany(Review::class);
    }
    function order(){
        return $this->hasMany(Order::class);
    }
}
