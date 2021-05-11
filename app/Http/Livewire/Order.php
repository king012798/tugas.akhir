<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produk;
use Darryldecode\Cart\CartCondition;
use Cart as ShoppingCart;
use Carbon\Carbon;

class Order extends Component
{
    public function render()
    {
        $data_produk = Produk::all();

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

}
