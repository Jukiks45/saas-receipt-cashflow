<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User demo untuk keperluan testing & tugas RPL.
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Urutan penting: categories dulu (dipakai transaksi & budget),
        // baru user_settings, transactions, dan budgets.
        $this->call([
            CategorySeeder::class,
            UserSettingSeeder::class,
            TransactionSeeder::class,
            BudgetSeeder::class,
        ]);
    }
}
