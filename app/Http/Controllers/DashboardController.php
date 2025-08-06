<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Carbon;
use illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $stokRendah = Produk::where('stock', '<=', 10)->get();
        // dd($stokRendah->name);
        $transaksiHariIni = Transaksi::whereDate('transaction_date', Carbon::today())->count();
        $laporanTerbaru = TransaksiDetail::with(['produk', 'transaksi'])
            ->whereHas('transaksi')
            ->orderByDesc(Transaksi::select('transaction_date')->whereColumn('transaksi.id', 'transaksi_details.transaksi_id')->take(1))
            ->paginate(10);

        // $laporanTerbaru = TransaksiDetail::with('produk', 'transaksi')
        //     ->whereHas('transaksi')
        //     ->get()
        //     ->sortByDesc(function ($item) {
        //         return $item->transaksi->transaction_date;
        //     })
        //     ->paginate(10)
        //     ->map(function ($item) {
        //         $item->transaction_date = $item->transaksi->transaction_date;
        //         $item->product_name = $item->produk->name;
        //         $item->customer_name = $item->transaksi->customer_name;
        //         $item->total = $item->produk->sale_price * $item->quantity;
        //         return $item;
        //     });

        $produk = Produk::paginate(5);

        return view('dashboard', compact('totalProduk', 'stokRendah', 'transaksiHariIni', 'laporanTerbaru', 'produk'));
    }
}
