<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
class MarketplaceUrl extends Model
{
    use HasFactory;

    protected $table = 'marketplace_url';
    
    protected $fillable = [
        'id_store',
        'url_tokopedia',
        'url_bukalapak',
        'url_shopee',
        'url_lazada',
    ];

    public function store(){
        return $this->belongsTo(Store::class, 'id_store', 'id');
    }

}
