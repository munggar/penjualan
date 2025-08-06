@extends('layouts.nav')
@section('content')
<style>
    @media (min-width: 768px) {
    .main-content {
        margin-left: 200px;
        margin-top: 100px;
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
    <div class="card shadow-sm p-4 my-5">
        <h1 class="h4 fw-bold mb-4">Edit Biaya</h1>
        <form action="{{ route('cost.update', $biaya->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Biaya</label>
                <input type="text" name="name" id="jenis" class="form-control" value="{{ $biaya->name }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="description" id="deskripsi" class="form-control" rows="3">{{ $biaya->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="date" id="tanggal" class="form-control" value="{{ $biaya->date }}" required>
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total (Rp)</label>
                <input type="number" name="amount" id="total" class="form-control" value="{{ $biaya->amount }}" required>
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('cost.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
