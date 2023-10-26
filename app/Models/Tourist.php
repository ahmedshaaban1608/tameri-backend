<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{

    use HasFactory;
    protected $fillable = ['id', 'country', 'gender', 'avatar', 'phone'];

    // public $incrementing = false;
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function review()
    {
        return $this->hasMany(Review::class);
    }
    function order()
    {
        return $this->hasMany(Order::class);
    }
}