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
             Schema::create('transaksi_details', function (Blueprint $table) {
    $table->id();

    // Foreign key ke tabel transaksi
    $table->unsignedBigInteger('transaksi_id');
    $table->foreign('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade');

    // Foreign key ke tabel products
    $table->unsignedBigInteger('product_id');
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
