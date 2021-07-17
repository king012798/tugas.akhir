@extends('layouts.app')
@section('title')
Produk
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
                <li class="breadcrumb-item active">Daftar Produk</li>
            </ul>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2><strong>Tabel</strong> Produk</h2>
                {{-- <a href="{{ route('produk.create') }}" class="btn bg-blue waves-effect">Tambah</a> --}}
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable"
                        id="table-produk">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_produk as $produk)
                            <tr>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->harga_beli }}</td>
                                <td>{{ $produk->harga_jual }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        
                                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn bg-yellow waves-effect">Edit</a>
                                        <button type="submit" class="btn bg-red waves-effect">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/table.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#table-produk').DataTable({
            responsive: true
        })
    })

</script>
@endsection
