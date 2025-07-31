@include('layouts.app')

<div class="container my-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Edit Produk</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('produk.update', $product->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Nama Produk</label>
          <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga Beli</label>
          <input type="number" name="purchase_price" class="form-control" value="{{ $product->purchase_price }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga Jual</label>
          <input type="number" name="sale_price" class="form-control" value="{{ $product->sale_price }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Stok</label>
          <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" disabled>
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
