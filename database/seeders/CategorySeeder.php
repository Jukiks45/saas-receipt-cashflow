<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed kategori transaksi default.
     * Slug di sini disamakan dengan value pada filter dropdown di halaman Transaksi.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'SaaS Cloud & Tools', 'slug' => 'saas-cloud', 'type' => 'expense', 'icon' => 'fa-cloud', 'color' => 'blue'],
            ['name' => 'Freelance Proyek', 'slug' => 'freelance', 'type' => 'income', 'icon' => 'fa-briefcase', 'color' => 'teal'],
            ['name' => 'Makanan & Minuman', 'slug' => 'makanan', 'type' => 'expense', 'icon' => 'fa-utensils', 'color' => 'amber'],
            ['name' => 'Hiburan', 'slug' => 'hiburan', 'type' => 'expense', 'icon' => 'fa-film', 'color' => 'pink'],
            ['name' => 'Utilitas', 'slug' => 'utilitas', 'type' => 'expense', 'icon' => 'fa-bolt', 'color' => 'slate'],
            ['name' => 'Gaji & Pemasukan', 'slug' => 'gaji', 'type' => 'income', 'icon' => 'fa-sack-dollar', 'color' => 'emerald'],
            ['name' => 'Belanja Modal', 'slug' => 'belanja', 'type' => 'expense', 'icon' => 'fa-bag-shopping', 'color' => 'purple'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
