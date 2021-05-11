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
                                        <th width="2%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carts as $index => $cart)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $cart['name'] }}</td>
                                            <td>
                                                <button wire:click="increaseItem('{{$cart['rowId']}}')" class="btn btn-warning btn-sm">+</button>
                                                &nbsp;
                                                {{ $cart['quantity'] }}
                                                &nbsp;
                                                <button wire:click="decreaseItem('{{$cart['rowId']}}')" class="btn btn-danger btn-sm">-</button>
                                            </td>
                                            <td class="text-right">{{ number_format($cart['price'],0,'','.') }}</td>
                                            <td>
                                                <button wire:click="removeItem('{{ $cart['rowId'] }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <h6 class="text-center">Empty Cart</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
