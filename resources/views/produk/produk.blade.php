<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manajemen Produk - Toko Jahit</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="app.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
  <header>
    <h1>Toko Aksesoris Jahit</h1>
    <nav>
      <a href="/">Dashboard</a>
      <a href="/produk">Produk</a>
      <a href="/transaksi">Transaksi</a>
      <a href="/laporan">Laporan</a>
    </nav>
  </header>

  <div class="container">
    <div class="card">
      <h2>Tambah Produk</h2>
      @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
      <form method="POST" action="{{ route('produk.store') }}">
        @csrf
        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" name="name" required />
        </div>
        <div class="form-group">
          <label>Harga Beli</label>
          <input type="number" name="purchase_price" required />
        </div>
        <div class="form-group">
          <label>Harga Jual</label>
          <input type="number" name="sale_price" required />
        </div>
        <div class="form-group">
          <label>Stok/Jumlah</label>
          <input type="number" name="stock" required />
        </div>
        <button class="btn" type="submit">Simpan</button>
      </form>
    </div>

    <div class="card">
      <h2>Daftar Produk</h2>
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>Rp{{ number_format($product->purchase_price, 0, ',', '.') }}</td>
              <td>Rp{{ number_format($product->sale_price, 0, ',', '.') }}</td>
              <td>{{ $product->stock }}</td>
              <td>
  <div class="d-flex gap-2">
    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
    </form>
    <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-secondary btn-sm">Edit</a>
    <a href="{{ route('produk.tambah', $product->id) }}" class="btn btn-secondary btn-sm">Tambah Stok</a>
  </div>
</td>

            </tr>
          @endforeach
          @if($products->isEmpty())
            <tr><td colspan="5">Belum ada produk.</td></tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
