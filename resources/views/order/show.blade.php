@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Order</h3>
        <div class="card-tools">
            <a href="{{ url('order') }}" class="btn btn-sm btn-default mt-1">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ID Order</label>
                    <p>{{ $order->id }}</p>
                </div>
                <div class="form-group">
                    <label>Nama Pembeli</label>
                    <p>{{ $order->nama_pembeli }}</p>
                </div>
                <div class="form-group">
                    <label>Barang ID</label>
                    <p>{{ $order->barang_id }} - {{ $order->barang->nama_barang ?? 'Barang tidak ditemukan' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jumlah</label>
                    <p>{{ $order->jumlah }}</p>
                </div>
                <div class="form-group">
                    <label>Tanggal Order</label>
                    <p>{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ url('/order/'.$order->id.'/edit') }}" class="btn btn-warning">Edit</a>
        <form action="{{ url('/order/'.$order->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</button>
        </form>
    </div>
</div>
@endsection