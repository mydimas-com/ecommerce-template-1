@extends('admin.layouts.app')
@section('admin-dashboard', 'active')

@section('content')
<div class="mb-3">
    <h2>
        Selamat Datang {{Auth::user()->store->name}}
    </h2>
</div>
<div class="row">
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-tale">
            <div class="card-body">
                <p class="mb-4">Pendapatan Bulan ini</p>
                <p class="fs-30 mb-2">@currency($income)</p>
                <p>per tanggal (1 - sekarang)</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
            <div class="card-body">
                <p class="mb-4">Transaksi Baru</p>
                <p class="fs-30 mb-2">{{$newOrder}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-danger">
            <div class="card-body">
                <p class="mb-4">Total Produk</p>
                <p class="fs-30 mb-2">{{$totalProduct}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
            <div class="card-body">
                <p class="mb-4">Pesanan Perlu Dikirim</p>
                <p class="fs-30 mb-2">{{$inprogress}}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Penjualan Bulan {{date('F Y')}}</h4>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">Produk Terlaris</p>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok Tersedia</th>
                                <th>Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProduct as $product)
                                <tr>
                                    <td>{{$product->product_name}}</td>
                                    <td class="font-weight-bold">@currency($product->product->price)</td>
                                    <td>{{$product->product->stock}}</td>
                                    <td>{{$product->quantity}}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data!</td>
                                </tr>    
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Judul</h4>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>

</script>
@endpush
