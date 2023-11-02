<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tourguide extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $incrementing = false;
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
        return $this->belongsTo(User::class,'id');
    }

    function languages(){
        return $this->hasMany(Language::class);
    }
    function areas(){
        return $this->hasMany(Area::class);
    }
    function reviews(){
        return $this->hasMany(Review::class);
    }
    function orders(){
        return $this->hasMany(Order::class);
    }
}
