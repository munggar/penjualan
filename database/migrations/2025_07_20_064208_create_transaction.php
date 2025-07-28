<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED
            $table->date('transaction_date');
            $table->string('customer_name');
            $table->decimal('total_amount', 10, 2);
            // $table->timestamps()->nullable();
            $table->string('payment_method')->nullable(); // Tambahkan kolom payment_method
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
