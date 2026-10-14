<?php

use App\Models\Pengaturan;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;

if (! function_exists('atur')) {
    // Ambil satu pengaturan; kalau kosong pakai nilai default
    function atur(string $kunci, ?string $default = ''): ?string
    {
        $v = Pengaturan::semua()[$kunci] ?? null;

        return ($v !== null && $v !== '') ? $v : $default;
    }
}

if (! function_exists('wa_link')) {
    // Tautan WhatsApp sekolah; jika nomor belum diisi di admin, arahkan ke halaman kontak
    function wa_link(?string $pesan = null): string
    {
        $nomor = preg_replace('/\D/', '', (string) atur('kontak_whatsapp', ''));

        if ($nomor === '') {
            return route('kontak');
        }

        $pesan ??= 'Halo SD Santo Fransiskus, saya ingin informasi pendaftaran siswa baru.';

        return 'https://wa.me/' . $nomor . '?text=' . rawurlencode($pesan);
    }
}

if (! function_exists('ikon')) {
    // Kolom "ikon" berisi kelas Font Awesome, mis. "fa-trophy" atau "fa-medal medal-gold"
    function ikon(?string $v): HtmlString
    {
        $v = trim((string) $v);
        if ($v === '') {
            return new HtmlString('');
        }
        if (preg_match('/^(fa-|medal-)[a-z0-9-]+( (fa-|medal-)[a-z0-9-]+)*$/', $v)) {
            return new HtmlString('<i class="fa-solid ' . e($v) . '" aria-hidden="true"></i>');
        }

        return new HtmlString(e($v));
    }
}

if (! function_exists('tanggal_id')) {
    function tanggal_id($tanggal): string
    {
        return $tanggal ? Carbon::parse($tanggal)->translatedFormat('j F Y') : '';
    }
}