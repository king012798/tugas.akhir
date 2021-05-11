<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_penjualan')->unsigned();
            $table->bigInteger('id_produk')->unsigned();
            $table->bigInteger('harga_produk');
            $table->bigInteger('qty');
            $table->timestamps();

            $table->foreign('id_penjualan')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_produk')->references('id')->on('produks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
