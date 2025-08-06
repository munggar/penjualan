@include('layouts.nav')

<!-- Konten -->
<div class="container my-5">
    <div class="card shadow-sm my-5">
        <div class="card-body">
            <h3 class="mb-4">Tambah Transaksi</h3>

            <!-- Tampilkan error validasi -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Tambah Transaksi -->
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input type="text" name="customer_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                        <option value="langsung">Bayar Langsung</option>
                        <option value="cicilan">Cicilan</option>
                    </select>
                </div>

                <label class="form-label">Produk</label>
                <div id="produk-container">
                    <div class="row mb-2 produk-row">
                        <div class="col-md-6">
                            <select name="produk_id[]" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} (Stok: {{ $product->stock }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="quantity[]" class="form-control" placeholder="Jumlah" required>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                            <button type="button" id="add-produk" class="btn btn-primary">+ Tambah</button>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-produk');

        addButton.addEventListener('click', function () {
            const container = document.getElementById('produk-container');
            const row = container.querySelector('.produk-row').cloneNode(true);

            row.querySelectorAll('select, input').forEach(input => input.value = '');
            container.appendChild(row);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                const row = e.target.closest('.produk-row');
                const container = document.getElementById('produk-container');
                if (container.children.length > 1) {
                    row.remove();
                }
            }
        });
    });
</script>
</body>

</html>
