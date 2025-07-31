@extends('layouts.app')

@section('content')
<div class="container py-4">
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
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->transaction_date }}</td>
                    <td>{{ $transaksi->customer_name }}</td>
                    <td>Rp{{ number_format($transaksi->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <form action="{{ url('transaksi/destroy/'.$transaksi->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('transaksi.cetak', $transaksi->id) }}" class="btn btn-sm btn-secondary" target="_blank">Cetak Nota</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
