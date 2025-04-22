<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $users = UserModel::all();
        return view('user.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|string|min:5|confirmed',
            'role' => 'required|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        UserModel::create($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk user tertentu.
     */
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan data user.
     */
    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|string|min:5|confirmed',
            'role' => 'required|string|max:50',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
