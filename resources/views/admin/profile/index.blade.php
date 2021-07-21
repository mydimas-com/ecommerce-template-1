@extends('admin.layouts.app')
@section('admin-store-profile', 'active')
@section('content')

<div class="d-flex mb-3">
    <a href="{{route('admin.stores')}}" class="btn btn-primary">
        <i class="mdi mdi-arrow-left"></i>
    </a>
    <h2 class="mt-2 ml-2">Toko Saya</h2>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <h6>Peringatan!</h6>
    @foreach ($errors->all() as $error)
    <li> {{ $error}}</li>
    @endforeach
</div>

@endif


<form action="{{url('admin/informasi-toko', $store->id )}}" method="patch" enctype="multipart/form-data">
    @csrf
    <div class="card p-4 mb-3">
        <div>
            <h3 class="mb-0">Informasi Toko</h3>
            <hr>
        </div>

        <div class="form-group row">
            <label for="name" class="col-lg-4">Nama Toko</label>
            <div class="col-lg-8">
                <label for="">{{$store->name}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Provinsi</label>
            <div class="col-lg-8">
                <label for="">{{$store->province->name}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Kota/Kabupaten</label>
            <div class="col-lg-8">
                <label for="">{{$store->city->name}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Kecamatan</label>
            <div class="col-lg-8">
                <label for="">-</label>

            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Kelurahan</label>
            <div class="col-lg-8">
                <label for="">-</label>

            </div>
        </div>
        <div class="form-group row">
            <label for="zipcode" class="col-lg-4">Kodepos</label>
            <div class="col-lg-2 col-sm-12">
                <label for="">{{$store->zipcode}}</label>

            </div>
        </div>

        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Alamat Lengkap</label>
            <div class="col-lg-8">
                <label for="">{{$store->address}}</label>
            </div>
        </div>
    </div>

</form>

<div class="card p-4 mb-3">
    <div>
        <h3 class="mb-0">Marketplace URL</h3>
        <hr>
    </div>

<form action="{{url('admin/marketplace-url', @$marketplace->id )}}" method="post">
        @csrf
        @if(!empty($marketplace))
            @method('PATCH')
        @endif
    <div class="form-group row">
        <label for="name" class="col-lg-2">Tokopedia</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="tokopedia" value="{{@$marketplace->url_tokopedia}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-lg-2">Bukalapak</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" name="bukalapak" value="{{@$marketplace->url_bukalapak}}">
        </div>
    </div>
    <div class="clearfix mt-3">
        <button type="submit" class="btn btn-primary col-sm-12 col-lg-2 float-right">Simpan</button>
    </div>

</form>

</div>

@endsection

@push('js')
    <script>
        $(document).ready(function(){
            console.log('readty'); 
        });
    </script>
@endpush