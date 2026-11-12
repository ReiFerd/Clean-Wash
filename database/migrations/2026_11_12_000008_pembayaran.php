<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->integer('id_pembayaran')->autoIncrement();
            $table->integer('id_transaksi');
            $table->string('metode_pembayaran', 20);
            $table->date('tanggal_pembayaran');
            // Foreign key:
            $table->foreign('id_transaksi', 'Pembayaran_Transaksi_FK')
                  ->references('id_transaksi')
                  ->on('transaksi')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
