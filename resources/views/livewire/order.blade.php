@section('title')
    Penjualan
@endsection
<div>
    <div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb breadcrumb-style ">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Penjualan</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href="index.html">
                            <i class="fas fa-home"></i> Penjualan</a>
                    </li>
                    <li class="breadcrumb-item active">Transaksi Penjualan</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Produk</h2>
                        </div>
                        <div class="body">
                            <div class="ml-auto col-md-4">
                                <input type="text" wire:model="search" placeholder="Cari Produk..." class="form-control">
                            </div>
                            <div class="row">
                                
                                @forelse ($data_produk as $produk)
                                <div class="col-md-3 col-sm-6">
                                    <div class="product-grid rounded">
                                        <div class="product-image">
                                            <a href="#">
                                                <img class="pic-1" src="../../assets/images/products/p7.jpg" alt="">
                                                <img class="pic-2" src="../../assets/images/products/p7-1.jpg" alt="">
                                            </a>
                                            <ul class="social">
                                                <li><button wire:click="addToCart({{$produk->id}})"><i class="fas fa-cart-plus"></i></button></li>
                                            </ul>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="title"><a href="#">{{ $produk->nama }}</a></h3>
                                            <div class="price">
                                                Rp. {{ number_format($produk->harga_jual, 0,'','.') }}
                                            </div>
                                            <span wire:click="addToCart({{$produk->id}})" href="">+ Add To Cart</span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="col-md-12 text-center">
                                        Tidak ada produk
                                    </div>
                                @endforelse
                                
                            </div>
                            <div class="text-center">
                                {{ $data_produk->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h2>Cart</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-hovered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Nama</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carts as $index => $cart)
                                        <tr>
                                            <td>{{ $index + 1 }} <br> <span wire:click="removeItem('{{ $cart['rowId'] }}')" class=""><i class="fas fa-trash"></i></span></td>
                                            <td>
                                                {{ $cart['name'] }} <br>
                                                {{ number_format($cart['price'],0,'','.') }}
                                            </td>
                                            <td>
                                                <button wire:click="increaseItem('{{$cart['rowId']}}')" class="btn btn-warning btn-sm">+</button>
                                                &nbsp;
                                                {{ $cart['quantity'] }}
                                                &nbsp;
                                                <button wire:click="decreaseItem('{{$cart['rowId']}}')" class="btn btn-danger btn-sm">-</button>
                                            </td>
                                            <td class="text-right">{{ number_format($cart['hargaTotal'],0,'','.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <h6 class="text-center">Empty Cart</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-center font-weight-bold">TOTAL</td>
                                        <td class="text-right font-weight-bold">{{ number_format($summary['total'],0,'','.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="col-md-6 ml-auto text-right">
                                <h6>BAYAR</h6> 
                                <input type="number" wire:model="bayar" wire:keydown.ENTER="totalPembayaran({{$summary['total']}})" style="width: 100px; text-align: right;">
                            </div>
                            <div class="col-md-6 ml-auto text-right">
                                <h6>KEMBALIAN</h6> 
                                <h6>{{ number_format($kembalian,0,'','.') }}</h6> 
                            </div>
                            <button class="btn btn-primary btn-block" wire:click="checkOut">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
