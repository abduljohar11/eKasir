<?php

namespace App\Models;

use App\Enums\PaymenMethod;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

#[
    Fillable([
        'invoice_code',
        'user_id',
        'total_price',
        'discount_amount',
        'grand_total',
        'pay_amount',
        'change_amount',
        'payment_method',
    ]),
]
class Transaction extends Model
{
    #[Override]
    protected function casts(): array
    {
        return [
            'total_price' => 'integer',
            'discount_amount' => 'integer',
            'grand_total' => 'integer',
            'pay_amount' => 'integer',
            'change_amount' => 'integer',
            'payment_method' => PaymenMethod::class,
        ];
    }

    /**
     * Relasi ke User yang melakukan transaksi.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke detail items/produk transaksi.
     */
    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
