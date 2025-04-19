<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_order')->insert([
            [
                'nama_pembeli' => 'Aprilia Putri Anggraeni',
                'barang_id' => 1, // misalnya Laptop ASUS ROG
                'jumlah' => 1,
                'tanggal_order' => '2025-04-19',
            ],
            [
                'nama_pembeli' => 'Meisy Nadia Nababan',
                'barang_id' => 3, // misalnya Keyboard Mechanical
                'jumlah' => 2,
                'tanggal_order' => '2025-04-20',
            ],
            [
                'nama_pembeli' => 'Indi Warda Ramadhani',
                'barang_id' => 5, // misalnya Flashdisk 64GB
                'jumlah' => 5,
                'tanggal_order' => '2025-04-21',
            ],
        ]);
    }
}