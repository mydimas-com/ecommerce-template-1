<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Models\Product;

class ProductInventory extends Model
{
    use HasFactory;

    protected $table = 'product_inventory';
    
    protected $fillable = [
        'id_store',
        'id_product',
        'stock',
    ];

    public function store(){
        return $this->belongsTo(Store::class, 'id_store', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
