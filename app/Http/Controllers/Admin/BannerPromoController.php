<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\BannerPromo;

use App\Http\Requests\BannerPromoStoreRequest;

class BannerPromoController extends Controller
{
    public function index(){
        $banners = BannerPromo::all();
        return view('admin.banner-promo.index', compact('banners'));
    }

    public function create(){
        return view('admin.banner-promo.form');
    }

    public function store(BannerPromoStoreRequest $request){
        $banner = new BannerPromo;

        $allowedfileExtension=['jpg','png'];
        $destination_path = 'public/uploads/images/banner-promo';
        $file = $request->file('image');
        $imageName = date('mdYHis') . uniqid() . '.' . $file->getClientOriginalExtension();
        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension,$allowedfileExtension);

        if($check){    
            $path = $file->storeAs($destination_path, $imageName);
            $banner->uuid = Str::uuid()->toString();
            $banner->image = $imageName;
            if($request->status){
                $banner->status = 'active';
            }else{
                $banner->status = 'inactive';
            }
            $banner->url = $request->url;
        }
        $status = $banner->save();
        if($status){
            return redirect()->route('admin.promo-banners')->with('success', 'Banner promo berhasil ditambah!');
        }else{
            return redirect()->route('admin.promo-banners')->with('error', 'Banner promo berhasil ditambah!');
        }
    }

    public function edit($id){
        $banner = BannerPromo::find($id);
        return view('admin.banner-promo.form', compact('banner'));
    }

    public function update($id, Request $request){
        $banner = BannerPromo::find($id);

        $banner->url = $request->url;
        if($request->status){
            $banner->status = 'active';
        }else{
            $banner->status = 'inactive';
        }

        if($request->hasFile('image')){
            $allowedfileExtension=['jpg','png'];
            $destination_path = 'public/uploads/images/banner-promo';
            $file = $request->file('image');
            
            $extension = $file->getClientOriginalExtension();
            $imageName = date('mdYHis') . uniqid() . '.' . $extension;
            $check = in_array($extension,$allowedfileExtension);
            if($check){
                $path = $file->storeAs($destination_path, $imageName);
                if($path){
                    if (\File::exists(storage_path('app/public/uploads/images/banner-promo/'.$banner->image))) {
                        \File::delete(storage_path('app/public/uploads/images/banner-promo/'.$banner->image));
                    }  
                }
                $banner->image = $imageName;
            }
        }
        $status = $banner->update();
        if($status){
            return redirect()->route('admin.promo-banners')->with('success', 'Banner promo berhasil diperbaharui!');
        }else{
            return redirect()->route('admin.promo-banners')->with('error', 'Banner promo berhasil diperbaharui!');
        }
            
    }
    public function destroy(Request $request)
    {
        $banner = BannerPromo::findOrFail($request->id_banner);

        if (\File::exists(storage_path('app/public/uploads/images/banner-promo/'.$banner->image))) {
            \File::delete(storage_path('app/public/uploads/images/banner-promo/'.$banner->image));
        }
        $status = $banner->delete();
        if($status){
            return redirect()->route('admin.promo-banners')->with('success', 'Banner promo berhasil dihapus!');
        }else{
            return redirect()->route('admin.promo-banners')->with('error', 'Banner promo berhasil dihapus!');
        }
    }
}
