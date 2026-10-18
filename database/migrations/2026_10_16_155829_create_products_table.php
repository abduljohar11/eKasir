<?php

use App\Enums\ProductType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name', 100)->index();
            $table->string('barcode', 100)->unique();
            $table->string('type', 30)->default(ProductType::default()->value); //fisik/digital jika digital tanpa stoct
            $table->unsignedBigInteger('buy_price')->default(0); // Harga pokok/beli
            $table->unsignedBigInteger('sell_price')->default(0); // Harga jual
            $table->unsignedInteger('stock')->default(0); // Jumlah stok
            $table->unsignedInteger('min_stock')->default(0); // Batas minimum stok untuk peringatann (warning).
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
