<?php

use App\Enums\PaymenMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code', 50)->unique(); //Nomor Struk/Nota Unik (Format: INV/YYYYMMDD/XXXX).
            $table->foreignUlid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedBigInteger('total_price')->default(0); // Total kotor belanja sebelum pajak/diskon
            $table->unsignedBigInteger('discount_amount')->default(0); // Nominal potongan diskon nota
            $table->unsignedBigInteger('grand_total')->default(0); // Total bersih tagihan yang wajib dibayar
            $table->unsignedBigInteger('pay_amount')->default(0); // Uang yang diserahkan/dibayarkan pelanggan
            $table->unsignedBigInteger('change_amount')->default(0); // Uang kembalian (pay_amount - grand_total)
            $table->string('payment_method', 30)->default(PaymenMethod::default()->value); // Metode bayar: cash, qris, debit, dll.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
