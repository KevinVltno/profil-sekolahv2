<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AkunGuruController extends Controller
{
    public function index()
    {
        return view('admin.guru', [
            'daftar'    => Admin::where('role', 'guru')->orderBy('nama')->get(),
            'pageKey'   => 'akun-guru',
            'pageTitle' => 'Akun Guru',
            'pageDesc'  => 'Kelola akun guru yang dapat masuk ke panel admin.',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:admins,username'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $akun = new Admin($data);
        $akun->role = 'guru';
        $akun->save();

        return redirect()->route('admin.guru.index')->with('success', 'Akun guru berhasil ditambahkan.');
    }

    public function update(Request $request, Admin $akun)
    {
        abort_unless($akun->role === 'guru', 404);

        $data = $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('admins', 'username')->ignore($akun->id)],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);   // kosong = password tidak diganti
        }
        $akun->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Akun guru berhasil diperbarui.');
    }

    public function destroy(Admin $akun)
    {
        abort_unless($akun->role === 'guru', 404);
        $akun->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Akun guru berhasil dihapus.');
    }
}