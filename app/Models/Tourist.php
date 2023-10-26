<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
   
    use HasFactory;
    protected $fillable = ['country', 'gender', 'avatar', 'phone', 'user_id'];
    protected $primaryKey = 'user_id';
    // public $incrementing = false;
    function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
    function review(){
        return $this->hasMany(Review::class);
    }
    function order(){
        return $this->hasMany(Order::class);
    }
}
