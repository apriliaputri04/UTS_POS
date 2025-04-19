<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_order', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('nama_pembeli'); // nama pembeli
            $table->unsignedBigInteger('barang_id'); // relasi ke m_barang
            $table->integer('jumlah'); // jumlah barang yang dipesan
            $table->date('tanggal_order'); // tanggal order
            $table->timestamps();

            // Foreign key constraint (opsional tapi direkomendasikan)
            $table->foreign('barang_id')->references('id')->on('m_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_order');
    }
};