<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

#[Fillable(['category_id', 'name', 'barcode', 'type', 'buy_price', 'sell_price', 'stock', 'min_stock', 'satuan'])]
class Product extends Model
{
    #[Override]
    protected function casts(): array
    {
        return [
            'category_id' => 'integer',
            'type' => ProductType::class,
            'buy_price' => 'integer',
            'sell_price' => 'integer',
            'stock' => 'integer',
            'min_stock' => 'integer',
        ];
    }

    /**
     * Relasi ke Kategori Produk.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Detail Transaksi.
     */
    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
