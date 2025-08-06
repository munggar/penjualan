@include('layouts.nav')

<div class="container mx-3 my-5">

    <!-- CARD TAMBAH PRODUK -->
    <div class="card shadow-sm mb-5" style="margin-top: 6%">
        <div class="card-header fw-bold">
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
                    <label class="form-label">Jenis Produk</label>
                    <input type="text" name="type" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna Produk</label>
                    <input type="text" name="color" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Satuan Yang Digunkan</label>
                    <select name="satuan" class="form-select" required>
                        <option value="">-- Pilih Satuan --</option>
                        <option value="pcs">Pcs</option>
                        <option value="kg">Kg</option>
                        <option value="karung">Karung</option>
                        <option value="pack">Pack</option>
                    </select>
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
        <div class="card-body p-2">
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('produk.index') }}" class="mb-3 d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" style="width: 80%"
                    placeholder="Cari produk...">
                <button type="submit" class="btn btn-primary">Cari</button>
                @if(request('search'))
                <div class="mb-3">
                    <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Hapus Pencarian</a>
                </div>
                @endif
            </form>



            <div class="table-responsive">
                <table class="table table-striped table-hover m-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Produk</th>
                            <th>Warna Produk</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok/Kuantiti/Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->color }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>Rp{{ number_format($item->purchase_price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->sale_price, 0, ',', '.') }}</td>
                            <td align="center">{{ $item->stock }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                    </form>
                                    <a href="{{ route('produk.edit', $item->id) }}"
                                        class="btn btn-secondary btn-sm">Edit</a>
                                    <a href="{{ route('produk.tambah', $item->id) }}"
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
        <div class="card-footer">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
