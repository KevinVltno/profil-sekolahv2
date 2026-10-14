<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function form()
    {
        return view('admin.akun', [
            'pageKey'   => 'akun',
            'pageTitle' => 'Ganti Password',
            'pageDesc'  => 'Perbarui password akun admin Anda.',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'lama' => ['required', 'current_password:admin'],
            'baru' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'lama.current_password' => 'Password lama salah.',
            'baru.min'              => 'Password baru minimal 8 karakter.',
            'baru.confirmed'        => 'Konfirmasi password tidak cocok.',
        ]);

        $request->user('admin')->update(['password' => $request->baru]);

        return redirect()->route('admin.akun')->with('success', 'Password berhasil diganti.');
    }
}