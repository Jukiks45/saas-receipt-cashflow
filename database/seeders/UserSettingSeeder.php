<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    /**
     * Seed pengaturan default (Telegram & notifikasi) untuk user demo.
     */
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            return;
        }

        UserSetting::updateOrCreate(
            ['user_id' => $user->id],
            [
                'telegram_number' => '+6281234567890',
                'telegram_connected' => true,
                'notify_daily_summary' => true,
                'notify_budget_alert' => true,
                'notify_anomaly_detection' => false,
            ]
        );
    }
}
