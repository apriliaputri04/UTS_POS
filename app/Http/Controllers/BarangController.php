<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang tersedia dalam sistem'
        ];

        $activeMenu = 'barang';

        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $barang = Barang::select('id', 'nama_barang', 'harga', 'stok');

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn  = '<a href="'.url('/barang/'.$barang->id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/barang/'.$barang->id.'/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/'.$barang->id).'">'
                    . csrf_field() . method_field('DELETE') . 
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {   
        // Menyusun data breadcrumb untuk ditampilkan di halaman 
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        // Menyusun informasi halaman
        $page = (object) [
            'title' => 'Tambah barang baru' // Judul halaman yang akan ditampilkan
        ];

        $activeMenu = 'barang';

        // Menampilkan view 'barang.create' dengan membawa data breadcrumb, page, dan activeMenu
        return view('barang.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request) // Menyimpan data dalam bentuk data table
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        try {
            Barang::create($request->all());
            return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data barang gagal disimpan: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Data barang tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', compact('barang', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function edit($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Data barang tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', compact('barang', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        $barang = Barang::find($id);
        
        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            $barang->update($request->all());
            return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data barang gagal diubah: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        
        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            $barang->delete();
            return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('barang.index')->with('error', 'Data barang gagal dihapus karena masih terdapat relasi dengan data lain');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->with('error', 'Data barang gagal dihapus: '.$e->getMessage());
        }
    }
}