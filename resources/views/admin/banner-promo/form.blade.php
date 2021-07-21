@extends('admin.layouts.app')
@section('admin-banner-promo', 'active')
@section('content')


@if(!empty($banner))
@php
$title = "Edit";
$btn = "Simpan";
@endphp
@else
@php
$title = "Tambah";
$btn = "Upload";
@endphp
@endif

<!-- <div class="d-flex mb-3">
    <a href="{{route('admin.penjualan.pesanan')}}" class="btn btn-primary">
        <i class="mdi mdi-arrow-left"></i>
    </a>
    <h2 class="mt-2 ml-2">Detail Pesanan</h2>
</div> -->

<style>
    #section1 {
    height: 90%; 
    width:100%;
    display:flex;
    align-items: center;
}
</style>
<div class="clearfix mb-3">
    <div class="float-left">
        <div  id="section1">
            <a href="{{route('admin.promo-banners')}}" class="btn btn-primary">
                <i class="mdi mdi-arrow-left"></i>
            </a>
            <h2 class="mt-2 ml-2 d-inline">{{$title}} Banner</h2>
            
        </div>
    </div>
    <div class="float-right">
        @if(!empty($banner))
            <button class="btn btn-md btn-danger deleteBanner" data-bannerid="{{$banner->id}}" data-toggle="modal" data-target="#deleteModal"><i class="ti-trash"></i></button>
        @endif
    </div>

    

</div>

@if(count($errors) > 0)
<div class="alert alert-danger">
    <strong>Perhatian</strong><br>
    <ul class="ml-3">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="bg-white rounded p-3 shadow mb-3">
    <form action="{{ url('/admin/banner-promo', @$banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(!empty($banner))
            @method('PATCH')
        @endif


            <div class="row">

                <div class="col-lg-4">
                    <div class="clearfix mb-2">
                        <label class="clearfix font-weight-bold mt-2">Preview Banner</label>
                    </div>
                    <div class="card shadow mb-2 thumbnail">
                        <img id="output" class="rounded" src="{{ @$banner->image? asset('/storage/uploads/images/banner-promo/' . $banner->image ) : asset('/img/default-img.png') }}" height="300px" style="object-fit: cover;" />
                    </div>
                    
                    <div class="mb-4">
                        <div class="inputWrapper btn btn-primary w-100 mt-3">
                            <input type="file" name="image" class="fileInput" accept=".png, .jpg, .jpeg"
                                onchange="loadFile(event)">Pilih Gambar
                            <input type="hidden" name="banner_id" id="banner_id" onchange="loadFile(event)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mt-2">
                    <div class="form-grup mb-3">
                        <label>Url</label>
                        <input type="text" name="url" class="form-control w-40"
                            value="{{ old('url', @$banner->url) }}">
                        <small class="font-italic">Url boleh kosong (Opsional).</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 mt-2">
                    <div class="form-grup mb-3">
                        <label>Status</label>
                        
                        <label class="switch">
                            <input type="checkbox" class="toggle" name="status"
                                {{@$banner->status == 'active' ? 'checked' : ''}} data-id="{{@$banner->id}}">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="clearfix">
                <div class="float-right">
                    <input type="submit" class="btn btn-success" style="width:120px;" value="{{$btn}}">
                </div>
            </div>
            
    </form>
</div>

<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <form action="{{route('admin.promo-banner.delete')}}" method="POST" class="remove-record-model">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body text-center">
                    <span style="font-size: 72px;" class="mx-auto"><i class="ti-trash text-danger"></i></span>

                    <h4 class="mb-3"><strong>Yakin ingin menghapus?</strong></h4>
                    <p>Data tidak dapat dikembalikan.</p>
                    <input type="hidden" name="id_banner" id="id_banner">
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col pl-0">
                            <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Batal</button>
                        </div>
                        <div class="col pr-0">
                            <button type="submit" class="btn btn-danger w-100">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('stylesheets')
    <style>
        .inputWrapper {
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .fileInput {
            width: 100%;
            cursor: pointer;
            height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 99;
            opacity: 0;
            -moz-opacity: 0;
            filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0)
        }
    </style>
@endpush
@push('js')
    <script>
        var loadFile = function (event, $id) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).ready(function(){
            
            $(document).on('click', '.deleteBanner', function () {
                var id = $(this).attr('data-bannerid');
                $('#id_banner').val(id);
            });
        });
    </script>
@endpush