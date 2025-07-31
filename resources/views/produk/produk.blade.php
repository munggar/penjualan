@include('layouts.app')

<div class="container my-5">

    <!-- CARD TAMBAH PRODUK -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white fw-bold">
            Tambah Produk
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('produk.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" name="purchase_price" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="number" name="sale_price" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok/Jumlah</label>
                    <input type="number" name="stock" class="form-control" required />
                </div>
                <button class="btn btn-success" type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <!-- CARD DAFTAR PRODUK -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">
            Daftar Produk
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>Rp{{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($product->sale_price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('produk.edit', $product->id) }}"
                                        class="btn btn-secondary btn-sm">Edit</a>
                                    <a href="{{ route('produk.tambah', $product->id) }}"
                                        class="btn btn-info btn-sm text-white">Tambah Stok</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
