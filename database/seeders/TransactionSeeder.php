<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Seed contoh transaksi untuk user demo, supaya dashboard, halaman transaksi,
     * dan halaman analisis tidak kosong saat pertama kali dicoba.
     */
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            return;
        }

        $categoryBySlug = Category::all()->keyBy('slug');

        $sampleTransactions = [
            ['merchant' => 'Kopi Nusantara', 'category' => 'makanan', 'type' => 'expense', 'amount' => 45000, 'payment_method' => 'qris', 'source' => 'ocr', 'days_ago' => 0],
            ['merchant' => 'Amazon Web Services', 'category' => 'saas-cloud', 'type' => 'expense', 'amount' => 1450000, 'payment_method' => 'kartu-kredit', 'source' => 'manual', 'days_ago' => 0],
            ['merchant' => 'Gaji Bulanan', 'category' => 'gaji', 'type' => 'income', 'amount' => 12000000, 'payment_method' => 'transfer', 'source' => 'manual', 'days_ago' => 1],
            ['merchant' => 'Proyek Website Klien A', 'category' => 'freelance', 'type' => 'income', 'amount' => 3500000, 'payment_method' => 'transfer', 'source' => 'manual', 'days_ago' => 2],
            ['merchant' => 'Netflix Langganan', 'category' => 'hiburan', 'type' => 'expense', 'amount' => 65000, 'payment_method' => 'kartu-kredit', 'source' => 'manual', 'days_ago' => 3],
            ['merchant' => 'PLN Token Listrik', 'category' => 'utilitas', 'type' => 'expense', 'amount' => 300000, 'payment_method' => 'ewallet', 'source' => 'manual', 'days_ago' => 4],
            ['merchant' => 'Indomaret Belanja Bulanan', 'category' => 'belanja', 'type' => 'expense', 'amount' => 275000, 'payment_method' => 'qris', 'source' => 'ocr', 'days_ago' => 5],
            ['merchant' => 'Warung Padang Sederhana', 'category' => 'makanan', 'type' => 'expense', 'amount' => 32000, 'payment_method' => 'tunai', 'source' => 'manual', 'days_ago' => 6],
        ];

        foreach ($sampleTransactions as $item) {
            $category = $categoryBySlug->get($item['category']);

            if (! $category) {
                continue;
            }

            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'merchant' => $item['merchant'],
                'type' => $item['type'],
                'amount' => $item['amount'],
                'payment_method' => $item['payment_method'],
                'source' => $item['source'],
                'transaction_date' => Carbon::now()->subDays($item['days_ago']),
            ]);
        }
    }
}
