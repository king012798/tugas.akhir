<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pembelian;

class PembelianController extends Controller
{
    public function index() {
        $produks = Produk::all();
        $pembelians = Pembelian::all();
        return view('pages.pembelian.index', compact('produks', 'pembelians'));
        
    }

    public function store(Request $request){
        $condition = $request->group1;

        $now = date('Y');
        $code = 1;
        $pembelian = \DB::table('pembelians')->latest('id')->first();
        $year = substr(now()->format('Y'), 2);
        
        if($pembelian != null){
            $orderYears = substr($pembelian->kode_pembelian,2,2);
            if($year > $orderYears){
                $code = 1;
            }else{
                $code = substr($pembelian->kode_pembelian, 4)+1;
            }
        }

        $code_order = str_pad(000 + $code , 3, 0, STR_PAD_LEFT);
        $getCode = "PB".$year.$code_order;
        

        if($condition == 'baru'){
            $produk  = Produk::create([
                'nama' => $request->nama,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->qty,
                'harga_beli' => $request->total_harga / $request->qty
            ]);

            Pembelian::create([
                'kode_pembelian' => $getCode,
                'id_produk' => $produk->id,
                'total_harga' => $request->total_harga,
                'qty' => $request->qty,
                'tanggal_pembelian' => $request->tanggal_pembelian
            ]);
        }else{
            $produk = Produk::findOrFail($request->id_produk);
            // dd($produk);
            $produk->update([
                'stok' => $produk->stok + $request->qty
            ]);

            Pembelian::create([
                'kode_pembelian' => $getCode,
                'id_produk' => $request->id_produk,
                'total_harga' => $request->total_harga,
                'qty' => $request->qty,
                'tanggal_pembelian' => $request->tanggal_pembelian
            ]);
        }

        return redirect()->route('pembelian.index');
    }
}
