@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data Order</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/order/'.$order->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_pembeli">Nama Pembeli</label>
                <input type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                    id="nama_pembeli" name="nama_pembeli"
                    value="{{ old('nama_pembeli', $order->nama_pembeli) }}" 
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
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}" 
                            {{ old('barang_id', $order->barang_id) == $barang->id ? 'selected' : '' }}
                            data-stok="{{ $barang->stok }}">
                            {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
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
                       id="jumlah" name="jumlah" 
                       value="{{ old('jumlah', $order->jumlah) }}" 
                       required min="1" max="20">
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Masukkan jumlah antara 1-100</small>
            </div>

            <div class="form-group">
                <label for="tanggal_order">Tanggal Order</label>
                <input type="date" class="form-control @error('tanggal_order') is-invalid @enderror" 
                       id="tanggal_order" name="tanggal_order" 
                       value="{{ old('tanggal_order', $order->tanggal_order) }}" 
                       required max="{{ date('Y-m-d') }}">
                @error('tanggal_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Tidak boleh melebihi tanggal hari ini</small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ url('order') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>

<script>
    // Real-time validation for jumlah based on selected barang's stock
    document.getElementById('barang_id').addEventListener('change', function() {
        const selectedBarang = this.options[this.selectedIndex];
        const stokTersedia = parseInt(selectedBarang.getAttribute('data-stok'));
        const jumlahInput = document.getElementById('jumlah');
        
        // Adjust max value (can't exceed 20 or available stock)
        jumlahInput.max = Math.min(20, stokTersedia);
        
        // Show current stock info
        const stokInfo = document.createElement('small');
        stokInfo.className = 'form-text text-muted';
        stokInfo.textContent = `Stok tersedia: ${stokTersedia}`;
        
        // Remove previous info if exists
        const existingInfo = jumlahInput.nextElementSibling.nextElementSibling;
        if (existingInfo && existingInfo.classList.contains('form-text')) {
            existingInfo.remove();
        }
        
        jumlahInput.after(stokInfo);
    });

    // Trigger on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('barang_id').dispatchEvent(new Event('change'));
    });
</script>
@endsection