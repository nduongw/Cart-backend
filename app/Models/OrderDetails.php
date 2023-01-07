<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'last_updated';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];
    protected $filltable = ['order_id', 'product_id', 'quantity', 'price'];
}
