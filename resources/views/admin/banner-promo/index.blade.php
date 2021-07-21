@extends('admin.layouts.app')
@section('admin-banner-promo', 'active')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <h6>Peringatan!</h6>
    @foreach ($errors->all() as $error)
    <li> {{ $error}}</li>
    @endforeach
</div>

@endif


<div class="clearfix">
    <h2 class="color-purple mb-4 float-left">Banner Promo</h2>
    <a href="{{route('admin.promo-banner.add')}}" class="btn btn-primary mb-4 float-right">Tambah Banner</a>
</div>

<div class="bg-white rounded p-4 shadow mb-3">
    <div class="row">
        @forelse($banners as $br)
        <div class="col-sm-12 col-lg-4 p-3">
            <div class="rounded shadow">
                <img src="{{$br->image != '-' ? asset('/storage/uploads/images/banner-promo/'.$br->image) : asset('/images/no-image-uploaded.png') }}" class="card-img-top rounded-top" alt=""
                    style="object-fit:cover; height:200px">
                <div class="card-body">
                    <div class="float-right">
                        <h4 class="float-left mt-1 mr-3">Tampilkan</h4>
                        <label class="switch">
                            <input type="checkbox" class="toggle" name="status"
                                {{$br->status == 'active' ? 'checked' : ''}} data-id="{{$br->id}}">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <a href="{{route('admin.promo-banner.edit', $br->id)}}" class="btnShow btn btn-primary w-100 mt-3">Edit</a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center w-100 py-5">
            <h6>Tidak ada data.</h6>
        </div>
        @endforelse
    </div>
</div>

@endsection

@push('css')
    <style>
        .right-panel {
            margin-left: 280px;
        }

        .inputWrapper {
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .fileInput {
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
        $(document).ready(function(){        
            $(function () {
                $('.toggle').change(function () {
                    var status = jQuery(this).prop('checked') == true ? 1 : 0;
                    var id = jQuery(this).data('id');

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/admin/banner/gantistatus',
                        data: {
                            'status': status,
                            'id': id
                        },
                        success: function (data) {}
                    });
                });
            });
            
        });

    


    </script>
@endpush






