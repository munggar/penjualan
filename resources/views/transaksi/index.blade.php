@extends('layouts.nav')

@section('content')
<style>
    main {
        padding-top: 50px;
    }

    @media (min-width: 768px) {
        main {
            padding-left: 188px;
            padding-top: 50px;
        }
    }
</style>

<main style="min-height: 100vh;">
    <div class="container-fluid p-4 card my-5 shadow-sm w-75">
        <h1 class="mb-4">Transaksi</h1>

        <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                    <th>Cetak</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->transaction_date }}</td>
                    <td>{{ $transaksi->customer_name }}</td>
                    <td>Rp{{ number_format($transaksi->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info"
                            style="color: white">Detail</a>
                        <form action="{{ url('transaksi/'.$transaksi->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('transaksi.cetak', $transaksi->id) }}" class="btn btn-sm btn-secondary"
                            target="_blank">Cetak Nota</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    <div class="card-footer">
        {{ $transaksis->links('pagination::bootstrap-5') }}
    </div>
    </div>

    </div>
</main>
@endsection
