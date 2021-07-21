<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $table = 'cart';

    protected $fillable = [
        'id_store',
        'id_product',
        'id_customer',
        'id_variant',
        'id_size',
        'quantity',
    ];
}
