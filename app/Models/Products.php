<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductVariant;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'uuid',
        'id_store',
        'id_category',
        'name',
        'slug',
        'price',
        'status',
        'weight',
        'description',
        'youtube_url',
    ];
    public function store(){
        return $this->belongsTo(Store::class, 'id_store', 'id');
    }
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'id_category', 'id');
    }
    public function images(){
        return $this->hasMany(ProductImage::class, 'id_product', 'id');
    }
    public function discount(){
        return $this->hasOne(ProductDiscount::class, 'id_product', 'id');
    }
    public function product_inventory(){
        return $this->hasOne(ProductInventory::class, 'id_product', 'id');
    }
    public function size(){
        return $this->hasMany(ProductSize::class, 'id_product', 'id');
    }
    public function variant(){
        return $this->hasMany(ProductVariant::class, 'id_product', 'id');
    }
}
