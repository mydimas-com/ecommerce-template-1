<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class OrderShipping extends Model
{
    use HasFactory;
    protected $table = 'order_shipping';
    
    protected $fillable = [
        'id_order',
        'resi',
        'sender_name',
        'receiver_name',
        'sender_phone',
        'receiver_phone',
        'shipment_agent',
        'shipping_address_from',
        'shipping_address_to',
        'shipping_cost',
        'status',
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
