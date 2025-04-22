<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'm_order';

    // Kolom-kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nama_pembeli',
        'barang_id',
        'jumlah',
        'tanggal_order',
    ];

    // Relasi dengan Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}