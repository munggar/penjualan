<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Contracts\Validation\Rule;
use illuminate\Pagination\LengthAwarePaginator;

class ProdukController extends Controller
{
    public function index(Request $request)
{
    $query = Produk::query();

    if ($request->has('search') && $request->search != '') {
        $search = strtolower($request->search);

        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
              ->orWhereRaw('LOWER(color) LIKE ?', ["%{$search}%"]);

        // Tambahkan kondisi untuk jenis produk jika diperlukan
        if(is_numeric($search)) {
            $query->orWhere('stock', $search);
        }
    }

    $products = $query->latest()->paginate(5);

    return view('produk.produk', compact('products'));
}


    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'type' => 'required',
            'color' => 'required',
            'satuan' => 'required',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Produk::create($request->all());

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy(Produk $product) {
        dd($product);
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }

    public function edit($id)
{
    $product = Produk::findOrFail($id);
    return view('produk.edit', compact('product'));
}

public function tambah($id)
{
    $product = Produk::findOrFail($id);
    return view('produk.tambah', compact('product'));
}

public function updateStok(Request $request, $id)
{
    $request->validate([
        // 'name' => 'required',
        // 'purchase_price' => 'required|numeric',
        // 'sale_price' => 'required|numeric',
        'stock' => 'required|numeric|min:1',
    ]);

    $product = Produk::findOrFail($id);
    $product->stock += $request->input('stock');
    $product->save();
    // $product->update($request->all());

    return redirect()->route('produk.index')->with('success', 'Stok Produk berhasil diperbarui.');
}

public function update(Request $request, $id)
{
    $product = Produk::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'type' => 'required',
        'color' => 'required',
        'purchase_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
    ]);

    // Pakai satuan baru kalau dipilih, kalau tidak tetap pakai yang lama
    $satuan = $request->filled('satuan') ? $request->satuan : $request->satuan_lama;

    // Update
    $product->update([
        'name' => $request->name,
        'type' => $request->type,
        'color' => $request->color,
        'satuan' => $satuan,
        'purchase_price' => $request->purchase_price,
        'sale_price' => $request->sale_price,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}


}
