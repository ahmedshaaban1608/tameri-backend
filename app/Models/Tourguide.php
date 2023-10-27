<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tourguide extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; 

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
