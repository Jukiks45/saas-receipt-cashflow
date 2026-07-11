<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'telegram_number',
        'telegram_connected',
        'notify_daily_summary',
        'notify_budget_alert',
        'notify_anomaly_detection',
    ];

    protected $casts = [
        'telegram_connected' => 'boolean',
        'notify_daily_summary' => 'boolean',
        'notify_budget_alert' => 'boolean',
        'notify_anomaly_detection' => 'boolean',
    ];

    /**
     * Relasi: 1 pengaturan dimiliki oleh 1 user (one-to-one).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
