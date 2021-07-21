<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    
    protected $fillable = [
        'id_order',
        'id_product',
        'id_variant',
        'id_size',
        'quantity',
        'product_name',
        'product_price',
        'discount',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
