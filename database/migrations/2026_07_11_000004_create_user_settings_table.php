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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();

            // Relasi one-to-one dengan users (1 user hanya punya 1 baris pengaturan).
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();

            $table->string('telegram_number')->nullable();
            $table->boolean('telegram_connected')->default(false);

            // Toggle notifikasi automasi AI (lihat halaman Pengaturan).
            $table->boolean('notify_daily_summary')->default(true);
            $table->boolean('notify_budget_alert')->default(true);
            $table->boolean('notify_anomaly_detection')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
