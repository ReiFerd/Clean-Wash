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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi')->autoIncrement();
            $table->integer('id_pelanggan');
            $table->integer('id_admin');
            $table->date('tanggal_transaksi');
            $table->string('status_laundry', 50);
            $table->string('metode_pengambilan', 20);
            // Foreign keys:
            $table->foreign('id_pelanggan', 'Transaksi_Pelanggan_FK')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');
            $table->foreign('id_admin', 'Transaksi_Admin_FK')
                  ->references('id_admin')
                  ->on('admin')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
