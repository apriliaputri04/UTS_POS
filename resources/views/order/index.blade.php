@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('order/create') }}">Tambah Pesanan</a>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_order">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pembeli</th>
                    <th>Barang ID</th>
                    <th>Jumlah</th>
                    <th>Tanggal Order</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
<!-- Jika butuh styling tambahan -->
@endpush

@push('js')
<script>
    $(document).ready(function () {
        $('#table_order').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('order/list') }}",
                dataType: "json",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nama_pembeli",  // Kolom untuk nama pembeli
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_id",  // Kolom untuk ID barang
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jumlah",  // Kolom untuk jumlah barang yang dipesan
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tanggal_order",  // Kolom untuk tanggal order
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",  // Kolom untuk tombol aksi
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush