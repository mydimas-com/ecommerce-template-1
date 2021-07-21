<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//model
use App\Models\MarketplaceUrl;

class MarketplaceUrlController extends Controller
{
    public function add(Request $request){
        $url = new MarketplaceUrl;
        $url->url_tokopedia = $request->tokopedia;
        $url->url_bukalapak = $request->bukalapak;
        $status = $url->save();

        if ($status) {
            return redirect()->back()->with('success', 'Profil Berhasil diperbaharui ');
        } else {
            return redirect()->back()->with('error', 'Profil Gagal diperbaharui');
        }
    }

    public function update($id, Request $request){
        $url = MarketplaceUrl::find($id);
        $url->url_tokopedia = $request->tokopedia;
        $url->url_bukalapak = $request->bukalapak;
        $status = $url->update();

        if ($status) {
            return redirect()->back()->with('success', 'Profil Berhasil diperbaharui ');
        } else {
            return redirect()->back()->with('error', 'Profil Gagal diperbaharui');
        }
    }
}
