<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false; // Jika tidak menggunakan timestamps
    protected $table = 'transaksi';
    protected $fillable = [
        'transaction_date', 'customer_name', 'total_amount', 'payment_method' // 'notes'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'transaksi_id');
    }

    public function pembayaranCicilan()
    {
        return $this->hasMany(PembayaranCicilan::class, 'transaksi_id');
    }

    public function totalDibayar()
    {
        return $this->pembayaran()->sum('jumlah_bayar');
    }

    public function sisaTagihan()
    {
        return $this->total_amount - $this->totalDibayar();
    }
}
