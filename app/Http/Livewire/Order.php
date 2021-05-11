<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produk;
use Darryldecode\Cart\CartCondition;
use Cart as ShoppingCart;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\Order as OrderModel;
use App\Models\DetailPenjualan;

class Order extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $bayar, $kembalian;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $data_produk = Produk::where('nama', 'like', '%'.$this->search.'%')->orderBy('created_at', 'DESC')->paginate(4);

        $items = ShoppingCart::session(Auth()->id())->getContent()->sortBy(function($cart){
            return $cart->attributes->get('added_at');
        });

        if(ShoppingCart::isEmpty()){
            $carts = [];

        }else{
            foreach($items as $item){
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'hargaTotal' => $item->getPriceSum(),
                ];
            }

            $carts = collect($cart);
        }

        $subTotal = ShoppingCart::session(Auth()->id())->getSubTotal();
        $hargaTotal = ShoppingCart::session(Auth()->id())->getTotal();

        $summary = [
            'sub_total' => $subTotal,
            'total' => $hargaTotal
        ];

        // dd($carts);

        return view('livewire.order', compact('data_produk','carts','summary'));
    }

    public function addToCart($id){
        $rowId = "Cart".$id;
        $cart = ShoppingCart::session(Auth()->id())->getContent();
        $checkItemId = $cart->whereIn('id', $rowId);

        if($checkItemId->isNotEmpty()){
            ShoppingCart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }else{
            $product = Produk::findOrFail($id);
            
            ShoppingCart::session(Auth()->id())->add([
                'id' => 'Cart'.$product->id,
                'name' => $product->nama,
                'price' => $product->harga_jual,
                'quantity' => 1,
                'attributes' => [
                    'added_at' => Carbon::now()
                ]
            ]);
        }
    }

    public function removeItem($id) {
        ShoppingCart::session(Auth()->id())->remove($id);
    }

    public function increaseItem($rowId) {
        $productId = substr($rowId, 4,5);
        $product = Produk::findOrFail($productId);
        
        $cart = ShoppingCart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id',$rowId);

        if($product->qty == $checkItem[$rowId]->quantity){
            session()->flash('error', 'Insufficient stock');
        }else{
            ShoppingCart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }
    }

    public function decreaseItem($rowId) {
        $cart = ShoppingCart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id',$rowId);
        if($checkItem[$rowId]->quantity == 1){
            $this->removeItem($rowId);
        }else{
            ShoppingCart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
        }
    }

    public function checkOut(){
        $carts = ShoppingCart::session(Auth()->id())->getContent();
        $hargaTotal = ShoppingCart::session(Auth()->id())->getTotal();
        
        $now = date('Y');
        $code = 1;
        $orders = \DB::table('orders')->latest('id')->first();
        $year = substr(now()->format('Y'), 2);
        
        if($orders != null){
            $orderYears = substr($orders->kode_penjualan,2,2);
            if($year > $orderYears){
                $code = 1;
            }else{
                $code = substr($orders->kode_penjualan, 4)+1;
                
            }
        }

        $code_order = str_pad(000 + $code , 3, 0, STR_PAD_LEFT);
        $getCode = "JL".$year.$code_order;

        $orders = OrderModel::create([
            'kode_penjualan' => $getCode,
            'total_harga' => $hargaTotal,
            'pembayaran' => $this->bayar,
            'kembalian' => $this->kembalian,
            'tanggal_penjualan' => Carbon::now()->format('Y-m-d'),
        ]);

        foreach($carts as $index => $cart){
            DetailPenjualan::create([
                'id_penjualan' => $orders->id,
                'id_produk' => substr($cart['id'],4,5),
                'harga_produk' => $cart['price'],
                'qty' => $cart['quantity']
            ]);
            ShoppingCart::session(Auth()->id())->remove($cart['id']);
        }

        

        $this->bayar = 0;
        $this->kembalian = 0;
    }

    public function totalPembayaran($totalHarga){
        $kembalian = $this->bayar - $totalHarga;
        $this->kembalian = $kembalian;
        // dd($totalPembayaran);
    }
}
