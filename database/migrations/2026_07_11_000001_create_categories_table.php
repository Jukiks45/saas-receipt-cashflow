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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            // Jenis kategori: apakah dipakai untuk transaksi pemasukan atau pengeluaran.
            $table->enum('type', ['income', 'expense'])->default('expense');
            // Ikon Font Awesome & warna tema untuk tampilan UI (badge kategori).
            $table->string('icon')->nullable();
            $table->string('color')->default('slate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
