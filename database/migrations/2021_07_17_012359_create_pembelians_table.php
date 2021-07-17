<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->char('kode_pembelian');
            $table->bigInteger('id_produk')->unsigned();
            $table->bigInteger('total_harga');
            $table->bigInteger('qty');
            $table->date('tanggal_pembelian');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produks')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
}
