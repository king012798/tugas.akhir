@extends('layouts.app')
@section('title')
Pembelian
@endsection
@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style ">
                <li class="breadcrumb-item">
                    <h4 class="page-title">Pembelian</h4>
                </li>
                <li class="breadcrumb-item bcrumb-1">
                    <a href="index.html">
                        <i class="fas fa-home"></i> Pembelian</a>
                </li>
                <li class="breadcrumb-item active">Transaksi Pembelian</li>
            </ul>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h2><strong>Form Pembelian</strong></h2>
                        <div class="body">
                            <form action="{{ route('pembelian.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Barang baru?</label>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-check form-check-radio">
                                                <label>
                                                    <input name="group1" type="radio" value="baru" />
                                                    <span>Ya</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-check form-check-radio">
                                                <label>
                                                    <input name="group1" type="radio" value="tidak" />
                                                    <span>No</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-pembelian">
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h2><strong>Table Pembelian</strong>Pembelian</h2>
                    </div>
                    <div class="body">
                        {{-- di sini --}}
                        <div class="table responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable"
                                id="table-produk">
                            <thead>
                                <tr>
                                    <th>Kode Pembelian</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Beli Produk</th>
                                    <th>Harga Jual Produk</th>
                                    <th>Total Harga Beli</th>
                                    <th>Stok Beli</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($pembelians as $pembelian)
                                <tr>
                                    <td>{{ $pembelian->kode_pembelian }}</td>
                                    <td>{{ $pembelian->produk->nama }}</td>
                                    <td>{{ $pembelian->produk->harga_beli }}</td>
                                    <td>{{ $pembelian->produk->harga_jual }}</td>
                                    <td>{{ $pembelian->total_harga }}</td>
                                    <td>{{ $pembelian->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('input[name="group1"]').click(function () {
            let html = '';
            if ($(this).val() == 'baru') {
                html += `
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama produk">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual"
                            placeholder="Harga Jual">
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="number" class="form-control" name="qty" placeholder="Stok">
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga Pembelian</label>
                        <input type="number" class="form-control" name="total_harga"
                            placeholder="Total Harga Pembelian">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pembelian</label>
                        <input type="date" class="form-control" name="tanggal_pembelian"
                            placeholder="Tanggal Pembelian">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="form-control btn btn-primary">
                    </div>
                `
            }else{
                html += `
                    <div class="form-group">
                        <select name="id_produk" id="" class="form-control">
                            <option value="">Pilih produk</option>
                            @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Stok baru</label>
                        <input type="number" name="qty" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Total Harga Pembelian</label>
                        <input type="number" name="total_harga" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="form-control btn btn-primary">
                    </div>
                `
            }

            $('.container-pembelian').html(html)
        })
    });

</script>
@endsection
