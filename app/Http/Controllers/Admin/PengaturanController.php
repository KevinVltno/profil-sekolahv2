<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Support\Upload;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    // Ambil konfigurasi halaman pengaturan; hanya admin yang boleh
    private function cfg(string $s): array
    {
        abort_unless(auth('admin')->user()?->isAdmin(), 403);

        $cfg = config("admin_menu.pengaturan.$s");
        abort_if($cfg === null, 404);

        return $cfg;
    }

    public function edit(string $s)
    {
        $cfg = $this->cfg($s);

        return view('admin.pengaturan', [
            's'         => $s,
            'fields'    => $cfg['fields'],
            'nilai'     => Pengaturan::semua(),
            'pageKey'   => $s,
            'pageTitle' => $cfg['judul'],
            'pageDesc'  => "Kelola pengaturan {$cfg['halaman']}.",
        ]);
    }

    public function update(Request $request, string $s)
    {
        $cfg = $this->cfg($s);

        /* 1. Rapikan input sebelum divalidasi */
        $bersih = [];
        foreach ($cfg['fields'] as $f) {
            if ($f['tipe'] === 'image') {
                continue;
            }

            $v = trim((string) $request->input($f['k']));

            if ($f['tipe'] === 'wa') {                       // 0812... menjadi 62812...
                $v = preg_replace('/\D/', '', $v);
                if ($v !== '' && $v[0] === '0') {
                    $v = '62' . substr($v, 1);
                }
            }
            if ($f['tipe'] === 'maps' && preg_match('/src=["\']([^"\']+)["\']/i', $v, $m)) {
                $v = html_entity_decode($m[1]);              // ambil src dari kode iframe
            }

            $bersih[$f['k']] = $v;
        }
        $request->merge($bersih);

        /* 2. Aturan validasi per tipe isian */
        $rules   = [];
        $atribut = [];
        foreach ($cfg['fields'] as $f) {
            $atribut[$f['k']] = $f['label'];

            $rules[$f['k']] = match ($f['tipe']) {
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:3072'],
                'email' => ['nullable', 'email', 'max:255'],
                'url'   => ['nullable', 'url:http,https', 'max:255'],
                'wa'    => ['nullable', 'digits_between:9,15'],
                'maps'  => ['nullable', 'max:2000', function ($attr, $value, $fail) {
                    if (! preg_match('#^https://(www\.google\.com/maps/embed|maps\.google\.com/)#', (string) $value)) {
                        $fail('Link Google Maps harus berupa kode sematkan (embed) dari Google Maps.');
                    }
                }],
                'area'  => ['nullable', 'string', 'max:2000'],
                default => ['nullable', 'string', 'max:255'],
            };
        }

        $request->validate($rules, [
            'url'            => ':attribute harus diawali http:// atau https://.',
            'email'          => 'Format :attribute tidak valid.',
            'digits_between' => ':attribute harus berupa angka 9 sampai 15 digit.',
            'max'            => ':attribute terlalu panjang atau berukuran terlalu besar.',
            'image'          => ':attribute harus berupa gambar.',
            'mimes'          => ':attribute harus berformat JPG, PNG, WEBP, atau GIF.',
            'uploaded'       => 'Unggahan :attribute gagal. Pastikan ukuran file maksimal 3 MB.',
        ], $atribut);

        /* 3. Simpan */
        $lama = Pengaturan::semua();

        foreach ($cfg['fields'] as $f) {
            $k = $f['k'];

            if ($f['tipe'] === 'image') {
                if ($request->hasFile($k)) {
                    $baru = Upload::simpan($request->file($k));
                    Upload::hapus($lama[$k] ?? null);
                    Pengaturan::updateOrCreate(['kunci' => $k], ['nilai' => $baru]);
                }
                continue;
            }

            Pengaturan::updateOrCreate(['kunci' => $k], ['nilai' => $bersih[$k]]);
        }

        return redirect()->route('admin.pengaturan.edit', $s)->with('success', $cfg['judul'] . ' berhasil disimpan.');
    }
}