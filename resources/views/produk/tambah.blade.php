@include('layouts.app')
<body>
  <div class="container my-5">
    <div class="card shadow-sm">
      <div class="card-header bg-info text-white fw-bold">
        Tambah Stok untuk: {{ $product->name }}
      </div>
      <div class="card-body">
        <form action="{{ route('produk.updateStok', $product->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="stock" class="form-label">Jumlah Stok Tambahan</label>
            <input type="number" name="stock" id="stock" class="form-control" placeholder="Masukkan jumlah stok" required>
          </div>

          <button type="submit" class="btn btn-success">Tambah Stok</button>
          <a href="{{ route('produk.index') }}" class="btn btn-secondary ms-2">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
