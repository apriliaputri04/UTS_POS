@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Barang Baru</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('barang') }}">
            @csrf
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                       id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" 
                       required minlength="3" maxlength="100">
                @error('nama_barang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Minimal 3 karakter, maksimal 100 karakter</small>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                       id="harga" name="harga" value="{{ old('harga') }}" 
                       required min="1000" max="1000000000" step="100">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Masukkan harga antara Rp1.000 - Rp1.000.000.000 (kelipatan 100)</small>
            </div>
            
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                       id="stok" name="stok" value="{{ old('stok') }}" 
                       required min="1" max="1000">
                @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Masukkan jumlah stok 1-1000</small>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('barang') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection