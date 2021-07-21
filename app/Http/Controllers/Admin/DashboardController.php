<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $date = date('m');

        $income = Order::whereHas('store', function ($query){ 
            $query->where('id_admin', Auth::user()->id);
        })
        ->where('status', '=', 'settlement')
        ->whereMonth('order_date', $date)
        ->sum('total');

        $newOrder = Order::whereHas('store', function ($query){ 
            $query->where('id_admin', Auth::user()->id);
        })
        ->where('status', '=', 'settlement')
        ->whereMonth('order_date', $date)
        ->count();

        $totalProduct = Products::whereHas('store', function ($query){ 
            $query->where('id_admin', Auth::user()->id);
        })
        ->count();

        $inprogress = Order::whereHas('store', function ($query){ 
            $query->where('id_admin', Auth::user()->id);
        })
        ->where('status', '=', 'inprogress')
        ->whereMonth('order_date', $date)
        ->count();

        $topProduct = OrderDetail::whereHas('order', function ($q){
            $q->whereHas('store', function($q2){
                $q2->where('id_admin', Auth::user()->id);
            });
            $q->where('status', 'settlement');
        })
        ->with('product:id,stock,price')
        ->selectRaw('id_product, product_name, sum(quantity) as quantity')
        ->groupBy('id_product','product_name')
        ->orderBy('quantity', 'desc')
        ->limit(5)
        ->get();

        return view('admin.dashboard.index', compact('income', 'newOrder', 'totalProduct', 'inprogress', 'topProduct'));
    }
}
