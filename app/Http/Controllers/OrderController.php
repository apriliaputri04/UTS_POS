<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Order',
            'list' => ['Home', 'Order']
        ];

        $page = (object) [
            'title' => 'Daftar pesanan dalam sistem'
        ];

        $activeMenu = 'order';

        return view('order.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $order = Order::with('barang:id,nama_barang')->select('id', 'nama_pembeli', 'barang_id', 'jumlah', 'tanggal_order');

        return DataTables::of($order)
            ->addIndexColumn()
            ->addColumn('barang', function ($order) {
                return $order->barang->nama_barang ?? '-';
            })
            ->addColumn('aksi', function ($order) {
                $btn  = '<a href="'.url('/order/'.$order->id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/order/'.$order->id.'/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/order/'.$order->id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Order',
            'list' => ['Home', 'Order', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah order baru'
        ];

        $activeMenu = 'order';
        $barang = Barang::all();

        return view('order.create', compact('breadcrumb', 'page', 'activeMenu', 'barang'));
    }

    public function store(Request $request)
    {
        $barang = Barang::all();

        // Validasi input
        $request->validate([
            'nama_pembeli' => 'required|string|max:100',
            'barang_id' => 'required|exists:m_barang,id', // Pastikan barang_id ada di tabel barang
            'jumlah' => 'required|integer|min:1', // Jumlah harus integer dan minimal 1
            'tanggal_order' => 'required|date', // Tanggal harus valid
        ]);

        // Menyimpan data order
        Order::create([
            'nama_pembeli' => $request->nama_pembeli,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_order' => $request->tanggal_order,
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect('/order')->with('success', 'Data order berhasil disimpan');
    }

    public function show($id)
    {
        $order = Order::with('barang')->findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Order',
            'list' => ['Home', 'Order', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail order'
        ];

        $activeMenu = 'order';

        return view('order.show', compact('order', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $barangs = Barang::all();

        $breadcrumb = (object) [
            'title' => 'Edit Order',
             'list' => ['Home', 'Order', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit order'
        ];

        $activeMenu = 'order';

        return view('order.edit', compact('order', 'barangs', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::all();

        // Validasi input
        $request->validate([
            'nama_pembeli' => 'required|string|max:100',
            'barang_id' => 'required|exists:m_barang,id', // Pastikan barang_id ada di tabel barang
            'jumlah' => 'required|integer|min:1', // Jumlah harus integer dan minimal 1
            'tanggal_order' => 'required|date', // Tanggal harus valid
        ]);

        Order::find($id)->update($request->all());

        return redirect('/order')->with('success', 'Data order berhasil diubah');
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect('/order')->with('error', 'Data order tidak ditemukan');
        }

        try {
            $order->delete();
            return redirect('/order')->with('success', 'Data order berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/order')->with('error', 'Data order gagal dihapus');
        }
    }
}
