@extends('admin.layouts.app')

@section('content')


@if(!empty($store))
    @php
        $title = "Edit";
        $btn = "Simpan";
    @endphp
@else
    @php
        $title = "Tambah";
        $btn = "Tambah";
    @endphp
@endif

<div class="d-flex mb-3">
    <a href="{{route('admin.stores')}}" class="btn btn-primary">
        <i class="mdi mdi-arrow-left"></i>
    </a>
    <h2 class="mt-2 ml-2">{{$title}} Toko</h2>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <h6>Peringatan!</h6>
    @foreach ($errors->all() as $error)
    <li> {{ $error}}</li>
    @endforeach
</div>

@endif


<form action="{{url('admin/daftar-toko', @$store->id )}}" method="post" enctype="multipart/form-data">
    @csrf
    @if(!empty($store))
    @method('PATCH')
    @endif
    <div class="card p-4 mb-3">
        <div>
            <h3 class="mb-0">Detail Toko</h3>
            <hr>
        </div>

        <div class="form-group row">
            <label for="name" class="col-lg-4">Nama Toko Cabang</label>
            <div class="col-lg-8">
                <input type="text" name="name" class="form-control" value="{{old('name', @$store->name)}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Provinsi</label>
            <div class="col-lg-8">
                <select class="form-control provinsi-asal" name="province">
                    <option value="0">-- pilih provinsi --</option>
                    @if(!empty($store))
                        @foreach ($provinces as $province => $value)
                            @if (old('province') == $province)
                                <option value="{{ $province  }}" selected>{{ $value }}</option>
                            @else
                                <option value="{{ $province  }}" {{$province == $store->id_province ? 'selected' : ''}}>{{ $value }}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach ($provinces as $province => $value)
                            @if (old('province') == $province)
                                <option value="{{ $province }}" selected>{{ $value }}</option>
                            @else
                                <option value="{{ $province }}">{{ $value }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Kota/Kabupaten</label>
            <div class="col-lg-8">
                <select class="form-control kota-asal" name="city">
                    <option value="">-- pilih kota --</option>
                    @if(!empty($store))
                        @foreach ($cities as $key => $city)
                            <option value="{{$key}}" {{$key == $store->id_city ? 'selected' : ''}}>{{$city}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Kecamatan</label>
            <div class="col-lg-8">
                <select class="form-control" name="" disabled>
                    <option value="">-- pilih kecamatan --</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Kelurahan</label>
            <div class="col-lg-8">
                <select class="form-control" name="" disabled>
                    <option value="">-- pilih kecamatan --</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="zipcode" class="col-lg-4">Kodepos</label>
            <div class="col-lg-2 col-sm-12">
                <input type="text" name="zipcode" value="{{old('zipcode', @$store->zipcode)}}"
                    class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="web_url" class="col-lg-4">Alamat Lengkap</label>
            <div class="col-lg-8">
                <textarea type="text" id="address" maxlength="250" name="address" style="overflow:auto;resize:none"
                    rows="13" cols="20" class="form-control">{{old('address', @$store->address)}}</textarea>

            </div>
        </div>

        <div>
            <h3 class="mb-0">Akun Pengelola</h3>
            <hr>
        </div>

        <div class="mb-3">
            <small class="font-italic">* Akun digunakan untuk akses toko cabang</small>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-lg-4">No Telp</label>
            <div class="col-lg-8">
                <input type="text" name="phone" class="form-control" value="{{old('phone', @$store->admin->phone)}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-lg-4">Email</label>
            <div class="col-lg-8">
                <input type="text" name="email" class="form-control" value="{{old('email', @$store->admin->email)}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-lg-4">Password</label>
            <div class="col-lg-8">
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row">
            <label for="password_confirmation" class="col-lg-4">Konfirmasi Password</label>
            <div class="col-lg-8">
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>

        <div class="clearfix">
            <button type="submit" class="btn btn-success col-lg-2 col-sm-12 float-right">
                Tambah
            </button>
        </div>
        
    </div>

</form>

@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{asset('admin/lib/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{asset('admin/lib/select2/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{asset('admin/lib/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            console.log('readty');
            //active select2
            $(".provinsi-asal , .kota-asal").select2({
                theme:'bootstrap4',width:'style',
            });

            //ajax select kota asal
            $('.provinsi-asal').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    $.ajax({
                        url: '/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city"]').empty();
                            $('select[name="city"]').append('<option value="">-- pilih kota asal --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city"]').append('<option value="">-- pilih kota asal --</option>');
                }
            });        
        });
    </script>

    <!-- @if(!empty($store))

        <script>
            $(document).ready(function(){;
                //active select2
                $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
                    theme:'bootstrap4',width:'style',
                });


                var selectedProvince = {!!@$store->id_province!!};
                var selectedCity = {!!@$store->id_city!!};
                
                $('select[name="province"]').val(selectedProvince);       
                $('select[name="city"]').val(selectedCity);      
                

            });
        </script>

    @endif -->

@endpush