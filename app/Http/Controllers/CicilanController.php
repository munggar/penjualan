<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranCicilan;

class CicilanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksi,id',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
        ]);

        // Buat cicilan baru
        PembayaranCicilan::create([
            'transaksi_id' => $request->transaksi_id,
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal_bayar' => $request->tanggal_bayar,
        ]);

        return redirect()
            ->route('transaksi.show', $request->transaksi_id)
            ->with('success', 'Pembayaran cicilan berhasil ditambahkan.');
    }
}
