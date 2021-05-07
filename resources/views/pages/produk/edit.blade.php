@extends('layouts.app')
@section('title')
Edit Produk
@endsection
@section('content')
<div class="block-header">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="breadcrumb breadcrumb-style ">
                <li class="breadcrumb-item">
                    <h4 class="page-title">Produk</h4>
                </li>
                <li class="breadcrumb-item bcrumb-1">
                    <a href="index.html">
                        <i class="fas fa-home"></i> Produk</a>
                </li>
                <li class="breadcrumb-item active">Edit Produk</li>
            </ul>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Edit Produk</h2>
            </div>
            <div class="body">
                <form action="{{ route('produk.update', $data_produk->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Produk" value="{{ $data_produk->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" name="harga_beli" placeholder="Masukan Harga Beli" value="{{ $data_produk->harga_beli }}">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" placeholder="Masukan Harga Jual" value="{{ $data_produk->harga_jual }}">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok Produk</label>
                        <input type="number" class="form-control" name="stok" placeholder="Masukan Stok Produk" value="{{ $data_produk->stok }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-blue waves-effect">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
