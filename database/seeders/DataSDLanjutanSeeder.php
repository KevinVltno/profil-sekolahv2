<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSDLanjutanSeeder extends Seeder
{
    public function run(): void
    {
        $ubah = fn (string $seksi, int $urutan, array $data) =>
            DB::table('konten')->where('seksi', $seksi)->where('urutan', $urutan)->update($data);

        /* ---- Visi dan Misi (rangkuman, ganti dengan teks resmi sekolah bila ada) ---- */
        $ubah('profil_visimisi', 1, [
            'judul' => 'Visi',
            'teks'  => 'Membentuk insan yang beriman kepada Tuhan, berakhlak mulia, dan cerdas, berlandaskan nilai moral serta persaudaraan yang dijiwai cinta kasih.',
        ]);
        $ubah('profil_visimisi', 2, [
            'judul' => 'Misi',
            'teks'  => implode("\n", [
                'Menumbuhkan keimanan dan nilai moral secara konsisten dalam kehidupan sekolah.',
                'Membangun komunitas sekolah yang bersaudara, disiplin, dan matang secara emosional melalui pendampingan pribadi dan layanan bimbingan bagi siswa.',
                'Meningkatkan kualitas guru dan siswa dalam menjalankan tugasnya sesuai tuntutan zaman.',
                'Memperkuat kerja sama dengan pihak internal maupun eksternal sekolah.',
            ]),
        ]);

        /* ---- Ekstrakurikuler (judul saja, foto diganti lewat admin) ---- */
        $ekskul = ['Pramuka', 'Seni Tari', 'Seni Musik', 'Karawitan', 'Teater', 'Marching Band'];
        foreach ($ekskul as $i => $nama) {
            $ubah('profil_ekskul', $i + 1, ['judul' => $nama]);
        }

        /* ---- Fasilitas ---- */
        $ubah('fasilitas', 4, [
            'judul' => 'Laboratorium Komputer dan Multimedia',
            'teks'  => 'Siswa belajar memanfaatkan teknologi informasi dan komunikasi melalui laboratorium komputer dan multimedia sekolah.',
        ]);

        /* ---- Program (hanya yang jelas bernuansa TK) ---- */
        $ubah('program', 2, [
            'judul' => 'Literasi dan Numerasi',
            'teks'  => 'Penguatan kemampuan membaca, menulis, dan berhitung sebagai dasar belajar di semua mata pelajaran.',
        ]);
        $ubah('program', 3, [
            'teks' => 'Menanamkan sopan santun, kejujuran, dan tanggung jawab dalam keseharian siswa.',
        ]);
        $ubah('program', 5, [
            'judul' => 'Seni Musik dan Tari',
            'teks'  => 'Mengembangkan bakat seni siswa melalui kegiatan musik, tari, dan karawitan.',
        ]);

        /* ---- Testimoni dan foto bersama ---- */
        foreach ([1, 2, 3] as $n) {
            $ubah('beranda_testimoni', $n, ['teks2' => 'Orang tua murid SD Santo Fransiskus']);
        }
        $ubah('guru_bersama', 1, [
            'judul' => 'Keluarga Besar SD Santo Fransiskus',
            'teks2' => 'Guru dan staf yang setiap hari mendampingi siswa belajar dan bertumbuh',
        ]);
    }
}