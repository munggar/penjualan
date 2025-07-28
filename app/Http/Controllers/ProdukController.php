<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;


class ProdukController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('produk.produk', compact('products'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
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
    $request->validate([
        'name' => 'required',
        'purchase_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'stock' => 'required|numeric',
    ]);

    $product = Produk::findOrFail($id);
    $product->update($request->all());

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}

}
