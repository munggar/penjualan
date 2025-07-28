<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transaksi - Toko Jahit</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/transaksi.css">
</head>
<body>
  <header>
    <h1>Toko Aksesoris Jahit</h1>
    <nav>
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <a href="{{ route('produk.index') }}">Produk</a>
      <a href="{{ route('transaksi.index') }}">Transaksi</a>
      <a href="#">Laporan</a>
    </nav>
  </header>

  <div class="container">
    <div class="card">
      <h2>Transaksi Penjualan</h2>
      <form method="POST" action="{{ route('transaksi.store') }}">
        @csrf
        <div class="form-group">
          <label for="produk_id">Pilih Produk</label>
          <select name="produk_id" id="produk_id">
            @foreach($produk as $item)
              <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="jumlah">Jumlah</label>
          <input type="number" name="jumlah" id="jumlah" min="1" required />
        </div>
        <div class="form-group">
          <label for="diskon">Diskon (opsional)</label>
          <input type="number" name="diskon" id="diskon" min="0" />
        </div>
        <button class="btn" type="submit">Proses Transaksi</button>
      </form>
    </div>

    <div class="card">
      <h2>Riwayat Transaksi</h2>
      <table>
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($riwayat as $transaksi)
          <tr>
            <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
            <td>{{ $transaksi->produk->nama_produk }}</td>
            <td>{{ $transaksi->jumlah }}</td>
            <td>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
