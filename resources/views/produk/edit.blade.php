@include('layouts.nav')

<div class="container my-5">
    <div class="card shadow my-5" >
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Produk</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="/produk/{{ $product->id }}/save">
                @csrf
                {{-- @method('PUT') --}}

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Produk</label>
                    <input type="text" name="type" class="form-control" value="{{ $product->type }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna Produk</label>
                    <input type="text" name="color" class="form-control" value="{{ $product->color }}" required>
                </div>
                @php
                $allUnits = ['pcs', 'kg', 'karung', 'pack'];
                $oldUnit = $product->satuan;
                $unitOptions = array_diff($allUnits, [$oldUnit]);
                @endphp

                {{-- Kirim satuan lama dengan hidden input --}}
                <input type="hidden" name="satuan_lama" value="{{ $oldUnit }}">

                <div class="mb-3">
                    <label class="form-label">Satuan Produk</label>
                    <select name="satuan" class="form-select">
                        <option value="">-- Pilih satuan baru (opsional) --</option>
                        @foreach ($unitOptions as $unit)
                        <option value="{{ $unit }}">{{ ucfirst($unit) }}</option>
                        @endforeach
                    </select>
                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti satuan.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="number" name="purchase_price" class="form-control"
                        value="{{ $product->purchase_price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="number" name="sale_price" class="form-control" value="{{ $product->sale_price }}"
                        required>
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
