<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    
    // public $timestamps = false;
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'last_updated';
    protected $fillable = ['order_id', 'customer_id', 'phone', 'address', 'total'];
    protected $filltable = ['order_id', 'customer_id', 'phone', 'address', 'total'];
}
