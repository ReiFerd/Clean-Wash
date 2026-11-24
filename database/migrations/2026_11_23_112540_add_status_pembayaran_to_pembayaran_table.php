<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->enum('status_pembayaran', [
                'belum_dibayar',
                'menunggu_verifikasi',
                'sudah_dibayar',
                'ditolak'
            ])->default('belum_dibayar');
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn('status_pembayaran');
        });
    }
};
