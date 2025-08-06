<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pembayaran;
use App\Models\PembayaranCicilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class TransaksiController extends Controller
{
    // Cetak Nota
    public function cetakNota($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);

        $pdf = PDF::loadView('transaksi.nota_pdf', compact('transaksi'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('nota-transaksi.pdf');
    }

    public function nota($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);

        $pdf = PDF::loadView('transaksi.nota', compact('transaksi'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('nota-transaksi-full.pdf');
    }

    // Menampilkan semua transaksi
    public function index()
    {
        $transaksis = Transaksi::paginate(10); // Menggunakan pagination untuk menampilkan 10 transaksi per halaman
        return view('transaksi.index', compact('transaksis'));
    }

    // Form tambah transaksi
    public function create()
    {
        $products = Produk::all();
        $transaksis = Transaksi::all();
        return view('transaksi.create', compact('products' , 'transaksis'));
    }

    // Simpan transaksi baru
public function store(Request $request)
{
    $request->validate([
        'transaction_date' => 'required|date',
        'customer_name' => 'required|string|max:255',
        'produk_id.*' => 'required|exists:products,id',
        'quantity.*' => 'required|integer|min:1',
        'metode_pembayaran' => 'required|in:langsung,cicilan',
    ]);

    try {
        DB::beginTransaction();

        // Hitung total belanja
        $total = 0;
        foreach ($request->produk_id as $i => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlah = $request->quantity[$i];
            $total += $produk->sale_price * $jumlah;
        }

        // Buat transaksi utama
        $transaksi = Transaksi::create([
            'transaction_date' => $request->transaction_date,
            'customer_name' => $request->customer_name,
            'total_amount' => $total,
            'payment_method' => $request->metode_pembayaran,
        ]);

        // Buat detail transaksi + kurangi stok
        foreach ($request->produk_id as $i => $produkId) {
            $produk = Produk::findOrFail($produkId);
            $jumlah = $request->quantity[$i];

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $produkId,
                'quantity' => $jumlah,
                'price' => $produk->sale_price,
            ]);

            $produk->decrement('stock', $jumlah);
        }

        // Simpan pembayaran pertama
        if ($request->metode_pembayaran === 'langsung') {
            Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'jumlah_bayar' => $total,
                'tanggal_bayar' => now(),
            ]);
        } else {
            PembayaranCicilan::create([
                'transaksi_id' => $transaksi->id,
                'jumlah_bayar' => 0, // cicilan awal belum dibayar
                'tanggal_bayar' => now(),
            ])->save(); // Simpan cicilan awal dengan jumlah bayar 0
        }

        DB::commit();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['msg' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
    }
}

    // Tampilkan detail transaksi
    public function show($id)
    {

        $transaksi = Transaksi::with('details.produk','pembayaran','pembayaranCicilan')->findOrFail($id);
        // dd($transaksi->pembayaranCicilan);

        // Kondisi Bayar langsung atau cicilan
        if ($transaksi->payment_method === 'langsung') {
            // Hitung total yang sudah dibayar
            $dibayar = $transaksi->pembayaran->sum('jumlah_bayar');
            // dd($dibayar);
            $sisa = $transaksi->total_amount - $dibayar;
            // dd($sisa);
            $status = $sisa > 0 ? 'Belum Lunas' : 'Lunas';
            $sisaText = $sisa > 0 ? 'Sisa Tagihan: Rp ' . number_format($sisa, 0, ',', '.') : '';
        } else {
            // Jika cicilan, hitung total yang sudah dibayar dari pembayaran cicilan
            $dibayar = $transaksi->pembayaranCicilan->sum('jumlah_bayar');
            $sisa = $transaksi->total_amount - $dibayar;
            $status = $sisa > 0 ? 'Belum Lunas' : 'Lunas';
            $sisaText = $sisa > 0 ? 'Sisa Tagihan: Rp ' . number_format($sisa, 0, ',', '.') : '';
        }

        // Hitung total yang sudah dibayar dari pembayaran cicilan
        // $dibayar = $transaksi->pembayaranCicilan->sum('jumlah_bayar');

        // // Hitung sisa tagihan
        // $sisa = $transaksi->total_amount - $dibayar;

        // // Jika transaksi belum lunas, tampilkan sisa tagihan
        // if ($sisa > 0) {
        //     $status = 'Belum Lunas';
        //     $sisaText = 'Sisa Tagihan: Rp ' . number_format($sisa, 0, ',', '.');
        // } else {
        //     $status = 'Lunas';
        //     $sisaText = '';
        // }

        // Tampilkan view dengan data transaksi dan status
        return view('transaksi.show', compact('transaksi', 'dibayar', 'sisa', 'status', 'sisaText'));
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
