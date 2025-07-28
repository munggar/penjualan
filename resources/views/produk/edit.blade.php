<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Produk</title>
  <link rel="stylesheet" href="/app.css" />
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>Edit Produk</h2>
      <form method="POST" action="{{ route('produk.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" name="name" value="{{ $product->name }}" required />
        </div>
        <div class="form-group">
          <label>Harga Beli</label>
          <input type="number" name="purchase_price" value="{{ $product->purchase_price }}" required />
        </div>
        <div class="form-group">
          <label>Harga Jual</label>
          <input type="number" name="sale_price" value="{{ $product->sale_price }}" required />
        </div>
        <div class="form-group">
          <label>Stok</label>
          <input type="number" name="stock" value="{{ $product->stock }}" required disabled/>
        </div>
        <button class="btn" type="submit">Simpan Perubahan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</body>
</html>
