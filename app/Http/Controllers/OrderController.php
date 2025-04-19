<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan semua order
    public function index()
    {
        $orders = Order::with('barang')->get();
        return view('order.index', compact('orders'));
    }

    // Tampilkan form tambah order
    public function create()
    {
        $barang = Barang::all();
        return view('order.create', compact('barang'));
    }

    // Simpan order baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'barang_id' => 'required|exists:m_barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_order' => 'required|date',
        ]);

        Order::create($request->all());

        return redirect()->route('order.index')->with('success', 'Order berhasil disimpan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $barang = Barang::all();
        return view('order.edit', compact('order', 'barang'));
    }

    // Update order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'barang_id' => 'required|exists:m_barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_order' => 'required|date',
        ]);

        $order->update($request->all());

        return redirect()->route('order.index')->with('success', 'Order berhasil diperbarui.');
    }

    // Hapus order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus.');
    }
}