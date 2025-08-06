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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // Jenis produk
            $table->string('color'); // Warna produk
            $table->string('satuan')->default('pcs'); // Satuan produk, defaultnya pcs
            $table->decimal('purchase_price', 10, 2); // Harga beli
            $table->decimal('sale_price', 10, 2);     // Harga jual
            $table->integer('stock')->default(0);
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
