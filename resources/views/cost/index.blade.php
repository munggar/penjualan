@extends('layouts.nav')
@section('content')
<style>
    @media (min-width: 768px) {
        .main-content {
            margin-left: 200px;
            margin-top: 80px;
        }
    }

    @media (max-width: 767.98px) {
        .main-content {
            margin-left: 0;
            margin-top: 75px;
        }
    }
</style>
<div class="container main-content">
    <div class="card shadow-sm p-4">
        <h1 class="h4 fw-bold mb-4">Manajemen Biaya</h1>
        <p class="text-muted mb-4">Lacak dan kelola semua pengeluaran seperti akomodasi, transportasi, dan lainnya.</p>
        <a href="{{ route('cost.create') }}" class="btn btn-primary mb-3">
            + Tambah Biaya
        </a>
        <form method="GET" class="row mb-3" action="{{ route('cost.index') }}">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan jenis/deskripsi..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary">Filter</button>
            </div>
            @if(request('search'))
            <div class="col-md-3">
                <a href="{{ route('cost.index') }}" class="btn btn-outline-secondary">Hapus Pencarian</a>
            </div>
            @endif
        </form>


        <table class="table table-bordered table-hover" style="z-index: 1">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Jenis Biaya</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($biaya as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                    <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('cost.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('cost.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <div class="card-footer">
        {{ $biaya->links('pagination::bootstrap-5') }}
    </div>
    </div>
</div>
@endsection
