<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Products;
use App\Models\ProductInventory;
use App\Models\Province;
use App\Models\City;
use App\Models\Admin;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    
    protected $fillable = [
        'id_admin',
        'name',
        'category',
        'id_province',
        'id_city',
        'zipcode',
        'address',
        'phone',
    ];
    public function product(){
        return $this->hasMany(Products::class, 'id_store', 'id');
    }
    public function product_inventory(){
        return $this->hasMany(ProductInventory::class, 'id_store', 'id');
    }
    public function province(){
        return $this->belongsTo(Province::class, 'id_province', 'province_id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'id_city', 'city_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }
}
