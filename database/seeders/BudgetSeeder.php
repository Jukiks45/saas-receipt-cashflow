<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BudgetSeeder extends Seeder
{
    /**
     * Seed anggaran bulanan default untuk user demo,
     * sesuai contoh limit Rp 15.000.000 pada halaman Analisis.
     */
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            return;
        }

        Budget::updateOrCreate(
            [
                'user_id' => $user->id,
                'category_id' => null,
                'month' => Carbon::now()->month,
                'year' => Carbon::now()->year,
            ],
            [
                'limit_amount' => 15000000,
            ]
        );
    }
}
