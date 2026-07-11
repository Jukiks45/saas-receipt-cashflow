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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Relasi ke users: 1 user memiliki banyak transaksi.
            // onDelete('cascade') -> jika user dihapus, semua transaksinya ikut terhapus.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Relasi ke categories: 1 kategori bisa dipakai banyak transaksi.
            // onDelete('restrict') -> kategori tidak bisa dihapus jika masih dipakai transaksi.
            $table->foreignId('category_id')->constrained()->restrictOnDelete();

            $table->string('merchant');
            $table->enum('type', ['income', 'expense'])->default('expense');
            $table->decimal('amount', 15, 2);

            $table->enum('payment_method', ['kartu-kredit', 'transfer', 'qris', 'ewallet', 'tunai'])
                ->default('qris');

            // Sumber input transaksi: manual (form) atau ocr (upload struk).
            $table->enum('source', ['manual', 'ocr'])->default('manual');

            // Path file struk hasil upload (jika ada).
            $table->string('receipt_path')->nullable();

            $table->text('notes')->nullable();

            $table->dateTime('transaction_date');

            $table->timestamps();

            // Index untuk mempercepat query filter berdasarkan user & tanggal.
            $table->index(['user_id', 'transaction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
