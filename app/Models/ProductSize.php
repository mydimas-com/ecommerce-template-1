<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_size';
    
    protected $fillable = [
        'id_product',
        'size',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
