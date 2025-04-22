<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_barang')->insert([
            [
                'nama_barang' => 'Laptop ASUS ROG',
                'harga' => 20000000,
                'stok' => 10,
            ],
            [
                'nama_barang' => 'Mouse Logitech',
                'harga' => 250000,
                'stok' => 40,
            ],
            [
                'nama_barang' => 'Keyboard Mechanical',
                'harga' => 500000,
                'stok' => 30,
            ],
            [
                'nama_barang' => 'Monitor LG 24 Inch',
                'harga' => 1500000,
                'stok' => 20,
            ],
            [
                'nama_barang' => 'Flashdisk 64GB',
                'harga' => 120000,
                'stok' => 10,
            ],
        ]);
    }
}