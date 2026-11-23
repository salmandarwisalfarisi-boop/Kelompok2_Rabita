<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest('user_id');

        // Filter Pencarian (Username, Email, No HP)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Filter Level / Status
        if ($request->filled('level') && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        $pengguna = $query->paginate(10)->withQueryString();

        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        if (!$request->filled('username') && $request->filled('nama')) {
            $request->merge(['username' => $request->nama]);
        }

        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'required|string|email|max:150|unique:tb_user,email',
            'no_hp'    => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'level'    => 'required|in:admin,user',
        ], [
            'username.required' => 'Nama pengguna (username) wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar.',
            'no_hp.required'    => 'Nomor telepon wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'level.required'    => 'Level pengguna wajib dipilih.',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'level'    => $request->level,
        ]);

        return redirect()->route('pengguna.index')
                         ->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function edit(User $pengguna)
    {
        $user = $pengguna;
        return view('pengguna.edit', compact('pengguna', 'user'));
    }

    public function update(Request $request, User $pengguna)
    {
        if (!$request->filled('username') && $request->filled('nama')) {
            $request->merge(['username' => $request->nama]);
        }

        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => ['required', 'string', 'email', 'max:150', Rule::unique('tb_user', 'email')->ignore($pengguna->user_id, 'user_id')],
            'no_hp'    => 'required|string|max:20',
            'password' => 'nullable|string|min:6',
            'level'    => 'required|in:admin,user',
        ], [
            'username.required' => 'Nama pengguna (username) wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar.',
            'no_hp.required'    => 'Nomor telepon wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $pengguna->username = $request->username;
        $pengguna->email    = $request->email;
        $pengguna->no_hp    = $request->no_hp;
        $pengguna->level    = $request->level;

        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return redirect()->route('pengguna.index')
                         ->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy(User $pengguna)
    {
        // Cegah menghapus diri sendiri saat login
        if ($pengguna->user_id === auth()->id()) {
            return redirect()->route('pengguna.index')
                             ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang login!');
        }

        // Hapus relasi keranjang atau pemesanan jika ada
        $pengguna->keranjang()->delete();
        $pengguna->delete();

        return redirect()->route('pengguna.index')
                         ->with('success', 'Pengguna berhasil dihapus!');
    }
}
