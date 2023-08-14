<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->integer('id_tagihan');
            $table->integer('id_pelanggan');
            $table->date('tanggal_pembayaran');
            $table->string('bulan_bayar');
            $table->integer('biaya_admin');
            $table->integer('total_bayar');
            $table->integer('id_admin');
            $table->string('virtual_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
