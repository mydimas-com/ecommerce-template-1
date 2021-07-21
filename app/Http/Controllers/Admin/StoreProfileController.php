<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Store;
use App\Models\MarketplaceUrl;

class StoreProfileController extends Controller
{
    public function index(){
        $store = Store::whereHas('admin', function ($query){ 
            $query->where('id', Auth::user()->id);
        })
        ->first();

        $marketplace = MarketplaceUrl::first();

        return view('admin.profile.index')->with(['store'=>$store, 'marketplace'=>$marketplace]);

    }

    public function update(){
        
    }
}
