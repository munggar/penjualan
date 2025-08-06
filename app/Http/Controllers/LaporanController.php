<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;

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

        // $laporan = $query->orderBy('transaction_date', 'desc')->paginate(1);
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
        $totalBiaya = Cost::all()->sum('amount');

        return view('laporan', compact('laporan', 'totalPendapatan', 'totalModal', 'totalBiaya'));
    }

    public function cetakPDF(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $query = Transaksi::with('details.produk');

        if ($tanggal_awal && $tanggal_akhir) {
            $query->whereBetween('transaction_date' , [$tanggal_awal . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
        }

        // $laporan = $query->orderBy('transaction_date', 'desc')->paginate(1);
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
        $totalBiaya = Cost::all()->sum('amount');

        // return view('laporan_pdf', compact('laporan', 'totalPendapatan', 'totalModal', 'totalBiaya'));
        $pdf = Pdf::loadView('laporan_pdf', compact('laporan', 'totalPendapatan', 'totalModal','totalBiaya'))
            ->setPaper('A4', 'portrait');
        return $pdf->download('laporan-penjualan.pdf');
    }

    public function exportPDF(Request $request)
    {
        $query = Transaksi::with('details.produk');

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
        $totalBiaya = Cost::all()->sum('amount');

        // Generate PDF
        $pdf = Pdf::loadView('report', compact('laporan', 'totalPendapatan', 'totalModal','totalBiaya'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-laba.pdf');
    }

    // public function cetakPDF(Request $request)
    // {
    //     $tanggal_awal = $request->tanggal_awal;
    //     $tanggal_akhir = $request->tanggal_akhir;

    //     $query = Transaksi::with('details.produk');

    //     if ($tanggal_awal && $tanggal_akhir) {
    //         $query->whereBetween('transaction_date', [$tanggal_awal . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
    //     }

    //     $laporan = $query->orderBy('transaction_date', 'desc')->get();

    //     $totalPendapatan = $laporan->sum(function ($trx) {
    //         return $trx->details->sum(function ($detail) {
    //             return $detail->harga * $detail->jumlah;
    //         });
    //     });
    //     dd($laporan);
    //      // Menghitung total modal

    //     $totalModal = $laporan->sum(function ($trx) {
    //         return $trx->details->sum(function ($detail) {
    //             return optional($detail->produk)->harga_modal * $detail->jumlah;
    //         });
    //     });
    //     $totalBiaya = Cost::all()->sum('amount');

    //     $pdf = Pdf::loadView('laporan_pdf', compact('laporan', 'totalPendapatan', 'totalModal','totalBiaya'))
    //         ->setPaper('A4', 'portrait');
    //     return $pdf->stream('laporan-penjualan.pdf');
    // }
}
