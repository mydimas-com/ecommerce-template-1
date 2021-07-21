<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\City;
use App\Models\Province;

class UserAddress extends Model
{
    use HasFactory;

    public $table = 'user_address';

    protected $fillable = [
        'id_customer',
        'name',
        'phone',
        'address',
        'id_province',
        'id_city',
        'zipcode',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'id_city', 'city_id');
    }
    public function province(){
        return $this->belongsTo(Province::class, 'id_province', 'province_id');
    }
}
