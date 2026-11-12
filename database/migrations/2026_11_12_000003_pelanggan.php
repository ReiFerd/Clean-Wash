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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->integer('id_pelanggan')->autoIncrement();
            $table->string('nama_pelanggan', 100);
            $table->string('alamat', 250);
            $table->string('no_telepon', 15)->unique();
            $table->string('username_pelanggan', 20)->unique();
            $table->string('password_pelanggan', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
