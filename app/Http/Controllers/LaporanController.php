<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $query = Transaksi::with('details.produk');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('transaction_date' , [$tanggal_awal . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
        }

        $laporan = $query->orderBy('transaction_date', 'desc')->get();

        $totalPendapatan = $laporan->sum(function ($trx) {
            return $trx->details->sum(function ($detail) {
                return $detail->price * $detail->quantity;
            });
        });

        $totalModal = $laporan->sum(function ($trx) {
            return $trx->details->sum(function ($detail) {
                return optional($detail->produk)->purchase_price * $detail->quantity;
            });
        });

        return view('laporan', compact('laporan', 'totalPendapatan', 'totalModal'));
    }

    public function cetakPDF(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $query = Transaksi::with('details.produk');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
        }

        $laporan = $query->orderBy('created_at', 'desc')->get();

        $totalPendapatan = $laporan->sum(function ($trx) {
            return $trx->details->sum(function ($detail) {
                return $detail->harga * $detail->jumlah;
            });
        });

        $totalModal = $laporan->sum(function ($trx) {
            return $trx->details->sum(function ($detail) {
                return optional($detail->produk)->harga_modal * $detail->jumlah;
            });
        });

        $pdf = PDF::loadView('laporan_pdf', compact('laporan', 'totalPendapatan', 'totalModal'));
        return $pdf->stream('laporan-penjualan.pdf');
    }
}
