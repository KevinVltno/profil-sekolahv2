<?php

namespace App\Http\Controllers;

use App\Models\Konten;

class HalamanController extends Controller
{
    public function beranda()
    {
        return view('pages.beranda', [
            'tumbuh'     => Konten::satu('beranda_tumbuh'),
            'sejarah'    => Konten::satu('beranda_sejarah'),
            'keunggulan' => Konten::seksi('beranda_keunggulan')->get(),
            'berita'     => Konten::seksi('berita')->limit(3)->get(),
            'galeri'     => $this->dataGaleri(),
            'testimoni'  => Konten::seksi('beranda_testimoni')->get(),
            'faq'        => Konten::seksi('beranda_faq')->get(),
        ]);
    }

    public function profil()
    {
        $vm = [];
        foreach (Konten::seksi('profil_visimisi')->get() as $r) {
            $vm[mb_strtolower(trim($r->judul))] = $r->paragraf();
        }

        return view('pages.profil', [
            'sejarah'    => Konten::satu('profil_sejarah'),
            'keunggulan' => Konten::seksi('profil_keunggulan')->get(),
            'ekskul'     => Konten::seksi('profil_ekskul')->get(),
            'prestasi'   => Konten::seksi('profil_prestasi')->get(),
            'visi'       => implode(' ', $vm['visi'] ?? []),
            'misi'       => $vm['misi'] ?? [],
        ]);
    }

    public function guru()
    {
        return view('pages.guru', [
            'bersama' => Konten::satu('guru_bersama'),
            'staf'    => Konten::seksi('guru_staf')->get(),
        ]);
    }

    public function fasilitas()
    {
        return view('pages.fasilitas', ['items' => Konten::seksi('fasilitas')->get()]);
    }

    public function program()
    {
        return view('pages.program', ['items' => Konten::seksi('program')->get()]);
    }

    public function berita()
    {
        return view('pages.berita', ['berita' => Konten::seksi('berita')->get()]);
    }

    public function beritaDetail(Konten $konten)
    {
        abort_unless($konten->seksi === 'berita', 404);

        return view('pages.berita-detail', [
            'b'       => $konten,
            'terkini' => Konten::seksi('berita')->limit(4)->get(),
        ]);
    }

    public function galeri()
    {
        return view('pages.galeri', ['galeri' => $this->dataGaleri()]);
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    // Data untuk galeri.js (di-escape karena galeri.js memasukkannya lewat innerHTML)
    private function dataGaleri(): array
    {
        return Konten::seksi('beranda_galeri')->get()->map(fn ($g) => [
            'src' => asset($g->gambar),
            'alt' => e($g->judul),
            'ket' => e($g->judul),
        ])->all();
    }
}