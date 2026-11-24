<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PengaturanAkunController extends Controller
{
    public function edit()
    {
        $this->ensureRegularUser();

        return view('user.pengaturan-akun');
    }

    public function update(Request $request)
    {
        $user = $this->ensureRegularUser();
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique('tb_user', 'username')->ignore($user->user_id, 'user_id'),
            ],
            'no_hp' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'current_password' => ['required', 'current_password'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'no_hp.required' => 'Nomor telepon wajib diisi.',
            'no_hp.regex' => 'Format nomor telepon tidak valid.',
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user->username = $validated['username'];
        $user->no_hp = $validated['no_hp'];
        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }
        $user->save();

        return redirect()->route('pengaturan.akun.edit')->with('success', 'Pengaturan akun berhasil diperbarui.');
    }

    private function ensureRegularUser()
    {
        $user = Auth::user();
        abort_unless($user && $user->level !== 'admin', 403);

        return $user;
    }
}
