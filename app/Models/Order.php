<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    
    protected $fillable = [
        'id_store',
        'id_customer',
        'no_order',
        'tax',
        'discount',
        'subtotal',
        'total',
        'order_date',
        'order_expire',
        'status',
        'payment_code',
        'payment_method',
        'payment_date',
    ];
}
