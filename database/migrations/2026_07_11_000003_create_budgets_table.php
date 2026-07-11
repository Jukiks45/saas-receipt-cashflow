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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Nullable: null berarti ini adalah anggaran/limit keseluruhan (bukan per kategori).
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();

            $table->unsignedTinyInteger('month'); // 1-12
            $table->unsignedSmallInteger('year');

            $table->decimal('limit_amount', 15, 2);

            $table->timestamps();

            // Satu user hanya boleh punya 1 budget untuk kombinasi kategori/bulan/tahun yang sama.
            $table->unique(['user_id', 'category_id', 'month', 'year'], 'unique_budget_per_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
