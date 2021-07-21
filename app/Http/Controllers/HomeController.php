<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


use App\Models\Store;
use App\Models\Products;
use App\Models\ProductCategory;
use App\Models\BannerPromo;

class HomeController extends Controller
{
    public function index(){
        $store = Store::where('category', 'center')
        ->with('product')
        ->first();


        $products= Products::where('status', '=', 'active')
        ->inRandomOrder()
        ->limit(8)
        ->get();

        $categories = ProductCategory::inRandomOrder()
        ->limit(8)
        ->get();

        $bannerPromo = BannerPromo::where('status', 'active')
        ->get();

        $selectedStore = $store->id;

        return view('user.landing.index', compact('products', 'selectedStore', 'categories', 'bannerPromo'));
    }
}
