<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceUrl extends Model
{
    use HasFactory;

    protected $table = 'marketplace_url';
    
    protected $fillable = [
        'url_tokopedia',
        'url_bukalapak',
        'url_shopee',
        'url_lazada',
    ];
}
