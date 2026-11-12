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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->integer('id_detail_transaksi')->autoIncrement();
            $table->integer('id_transaksi');
            $table->integer('id_layanan');
            $table->decimal('berat_cucian', 5, 2);
            $table->decimal('total_harga', 10, 2);
            // Foreign keys:
            $table->foreign('id_transaksi', 'Detail_transaksi_Transaksi_FK')
                    ->references('id_transaksi')
                    ->on('transaksi')
                    ->onDelete('cascade');
            $table->foreign('id_layanan', 'Detail_transaksi_Layanan_FK')
                    ->references('id_layanan')
                    ->on('layanan') 
                     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
