<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan (opsional kalau nama tabelnya sudah sesuai dengan konvensi)
    protected $table = 'm_barang';

    // Field yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
    ];
}