<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Store;
use App\Models\Admin;
use App\Models\Province;
use App\Models\City;

use App\Http\Requests\StoresStoreRequest;

use DataTables;

class StoreController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Store::where('category', '!=', 'center')
                ->with('city')
                ->get();
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('city', function($data){
                    return $data->city->name;
                })
                ->addColumn('action', function($data){
                    $btn = '
                    <a href="daftar-toko/' . $data->id . '/edit" class="btn btn-info"><i class="ti-pencil-alt"></i></a>
                    <button class="btn btn-danger deleteData" data-storeId="'. $data->id .'"
                    data-storeTitle="' . $data->name .'" data-toggle="modal"
                    data-target="#deleteModal"><i class="ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.store.index');
    }

    public function create(){
        $provinces = Province::pluck('name', 'province_id');
        return view('admin.store.form')->with('provinces', $provinces);
    }

    public function store(StoresStoreRequest $request){
        $status;

        $storeAdmin = new Admin;
        $storeAdmin->email = $request->email;
        $storeAdmin->phone = $request->phone;
        $storeAdmin->status = 'active';
        $storeAdmin->role = '0';
        $storeAdmin->password = Hash::make($request->password);
        if($storeAdmin->save()){
            $store = new Store;
            $store->id_admin = $storeAdmin->id; 
            $store->name = $request->name;
            $store->category = 'branch';
            $store->id_province = $request->province;
            $store->id_city = $request->city;
            $store->zipcode= $request->zipcode;
            $store->address = $request->address;
            $store->phone = $request->phone;
            $status = $store->save();
        }

        if($status){
            return redirect()->route('admin.stores')->with('success', 'Toko berhasil ditambah!');
        }else{
            return redirect()->route('admin.stores')->with('error', 'Toko berhasil ditambah!');
        }
    }

    public function edit($id)
    {
        $store = Store::where('id','=', $id)
            ->with('admin')
            ->first();

        $provinces = Province::pluck('name', 'province_id');
        $cities = City::where('province_id', $store->id_province)->pluck('name', 'city_id');

        return view('admin.store.form', compact('store', 'provinces', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        $store->name = $request->name;
        $store->id_province = $request->province;
        $store->id_city = $request->city;
        $store->zipcode= $request->zipcode;
        $store->address = $request->address;

        $store->admin->phone = $request->phone;

        $status = $store->update();

        if($status){
            return redirect()->route('admin.stores')->with('success', 'Toko berhasil diperbaharui!');
        }else{
            return redirect()->route('admin.stores')->with('error', 'Toko berhasil diperbaharui!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->idStore;
        
        $status = Store::where('id', $id)
        ->delete();

        if($status){
            return redirect()->route('admin.stores')->with('success', 'Toko berhasil dihapus!');
        }else{
            return redirect()->route('admin.stores')->with('error', 'Toko berhasil dihapus!');
        }
    }

}
