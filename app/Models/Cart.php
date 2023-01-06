<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'product_id', 'user_id', 'quantity'];
    protected $filltable = ['id', 'product_id', 'user_id', 'quantity'];
}
