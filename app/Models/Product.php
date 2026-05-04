<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','type','price','weight','age',
        'location','health_status','image','is_sold','user_id'
    ];
}