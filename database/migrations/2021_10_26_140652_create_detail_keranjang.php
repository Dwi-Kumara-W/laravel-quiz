<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKeranjang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_keranjang', function (Blueprint $table) {
            $table->id('id_detail_keranjang');
            $table->foreignId('id_keranjang');
            $table->foreignId('id_barang');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->integer('total');
            $table->timestamps();
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjang')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('barang')
            ->onDelete('cascade')->onUpdate('cascade');
        });


        // Schema::table('detail_keranjang', function (Blueprint $table) {
        //     $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjang')
        //     ->onDelete('cascade')->onUpdate('cascade');
        // });

        // Schema::table('detail_keranjang', function (Blueprint $table) {
        //     $table->foreign('id_barang')->references('id_barang')->on('barang')
        //     ->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_keranjang');
    }
}
