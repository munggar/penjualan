<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
     protected $table = 'products'; // override nama tabel

    protected $fillable = [
        'name', 'purchase_price', 'sale_price', 'stock', 'color', 'type', 'satuan'
    ];

    // Relasi ke detail transaksi
    public function transactionDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'product_id');
    }
}
