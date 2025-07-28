@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaksi</h1>

    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Total</th>
                <th>Aksi</th>
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
                        <form action="transaksi/destroy/$transaksi->id" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>
            <a href="{{ route('transaksi.cetak', $transaksi->id) }}" class="btn btn-print" target="_blank">Cetak Nota</a>
        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
