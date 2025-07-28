<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $stokRendah = Produk::where('stock', '<=', 5)->count();
        $transaksiHariIni = Transaksi::whereDate('transaction_date', Carbon::today())->count();

        $laporanTerbaru = TransaksiDetail::with('produk', 'transaksi')
            ->whereHas('transaksi')
            ->get()
            ->sortByDesc(function ($item) {
                return $item->transaksi->transaction_date;
            })
            ->take(10)
            ->map(function ($item) {
                $item->transaction_date = $item->transaksi->transaction_date;
                $item->product_name = $item->produk->name;
                $item->customer_name = $item->transaksi->customer_name;
                $item->total = $item->produk->sale_price * $item->quantity; // ⬅️ bagian penting
                return $item;
            });


        $produk = Produk::all();

        return view('dashboard', compact(
            'totalProduk',
            'stokRendah',
            'transaksiHariIni',
            'laporanTerbaru',
            'produk'
        ));
    }
}
