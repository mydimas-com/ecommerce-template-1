<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Models\OrderDetail;
use App\Models\OrderShipping;
use App\Models\User;

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

    public function store(){
        return $this->belongsTo(Store::class, 'id_store', 'id');
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class, 'id_order', 'id');
    }

    public function shipping(){
        return $this->hasOne(OrderShipping::class, 'id_order', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }
}
