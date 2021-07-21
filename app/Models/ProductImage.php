<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_image';
    
    protected $fillable = [
        'id_product',
        'url',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
