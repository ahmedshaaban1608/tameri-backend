<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tourist extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $fillable = ['id', 'country', 'gender', 'avatar', 'phone'];

    // public $incrementing = false;
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function reviews()
    {
        return $this->hasMany(Review::class);
    }
    function orders()
    {
        return $this->hasMany(Order::class);
    }
}