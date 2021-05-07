<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    //Menampilkan produk ke halaman index
    public function index(){
        $data_produk = Produk::orderBy('nama', 'ASC')->get();

        return view('pages.produk.index', compact('data_produk'));
    }

    //Menampilkan halaman tambah
    public function create(){
        return view('pages.produk.create');
    }

    //Memproses tambah data
    public function store(Request $request) {
        $data_produk = Produk::create([
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk.index');
    }

    //Menampilkan halaman edit serta datanya
    public function edit($produk){
        $data_produk = Produk::findOrFail($produk);

        return view('pages.produk.edit', compact('data_produk'));
    }

    //Mengubah data
    public function update(Request $request, $produk){
        $data_produk = Produk::findOrFail($produk);
        $data_produk->update([
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk.index');
    }

    //Menghapus data
    public function destroy($produk){
        $data_produk = Produk::findOrFail($produk);
        $data_produk->delete();

        return redirect()->route('produk.index');
    }


}
