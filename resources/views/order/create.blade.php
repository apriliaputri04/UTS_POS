@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Order Baru</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('order') }}">
            @csrf
            <div class="form-group">
                <label for="nama_pembeli">Nama Pembeli</label>
                <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror" 
                       id="nama_pembeli" name="nama_pembeli" value="{{ old('nama_pembeli') }}" 
                       required minlength="3" maxlength="100">
                @error('nama_pembeli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 3 karakter, maksimal 100 karakter</small>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang</label>
                <select class="form-control @error('barang_id') is-invalid @enderror" 
                        id="barang_id" name="barang_id" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->nama_barang }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
                @error('barang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                       id="jumlah" name="jumlah" value="{{ old('jumlah') }}" 
                       required min="1" max="20">
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Masukkan jumlah 1-100</small>
            </div>

            <div class="form-group">
                <label for="tanggal_order">Tanggal Order</label>
                <input type="date" class="form-control @error('tanggal_order') is-invalid @enderror" 
                       id="tanggal_order" name="tanggal_order" 
                       value="{{ old('tanggal_order', date('Y-m-d')) }}" 
                       required max="{{ date('Y-m-d') }}">
                @error('tanggal_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Maksimal tanggal hari ini</small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('order') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection