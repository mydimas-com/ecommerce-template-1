<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Store;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = "admin";

    protected $fillable = [
        'email',
        'phone',
        'image',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function store(){
        return $this->hasOne(Store::class, 'id_admin', 'id');
    }
}
