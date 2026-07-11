<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'month',
        'year',
        'limit_amount',
    ];

    protected $casts = [
        'limit_amount' => 'decimal:2',
    ];

    /**
     * Relasi: 1 budget dimiliki oleh 1 user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: 1 budget (opsional) terikat pada 1 kategori.
     * Null berarti budget berlaku untuk keseluruhan pengeluaran (bukan per kategori).
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
