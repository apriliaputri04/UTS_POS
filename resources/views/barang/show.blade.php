@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Barang</h3>
        <div class="card-tools">
            <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-1">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ID Barang</label>
                    <p>{{ $barang->id }}</p>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <p>{{ $barang->nama_barang }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Harga</label>
                    <p>Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <p>{{ $barang->stok }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url('/barang/'.$barang->id.'/edit') }}" class="btn btn-warning">Edit</a>
        <form action="{{ url('/barang/'.$barang->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</button>
        </form>
    </div>
</div>
@endsection