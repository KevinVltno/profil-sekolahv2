<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSDSeeder extends Seeder
{
    public function run(): void
    {
        $ubah = fn (string $seksi, int $urutan, array $data) =>
            DB::table('konten')->where('seksi', $seksi)->where('urutan', $urutan)->update($data);

        /* ---- Sejarah ---- */
        $ubah('beranda_sejarah', 1, [
            'judul' => 'Lebih dari Lima Dekade Mendampingi Anak-Anak Sragen',
            'teks'  => 'SD Santo Fransiskus Sragen adalah sekolah dasar Katolik yang berdiri sejak tahun 1968 di bawah naungan Yayasan Mardi Lestari Sragen. Sejak awal, kami berkomitmen menghadirkan tempat belajar yang menyenangkan, aman, dan penuh kasih bagi anak-anak. Kini sekolah kami terakreditasi A dan menjalankan Kurikulum Merdeka.',
        ]);
        $ubah('profil_sejarah', 1, [
            'judul' => 'Mendampingi Anak Belajar dan Bertumbuh dengan Penuh Kasih',
            'teks'  => 'SD Santo Fransiskus Sragen adalah sekolah dasar Katolik yang berdiri sejak tahun 1968 di bawah naungan Yayasan Mardi Lestari Sragen dan telah terakreditasi A. Kami menghadirkan suasana belajar yang menyenangkan, aman, dan penuh kasih, dengan pembelajaran yang mengacu pada Kurikulum Merdeka.',
        ]);

        /* ---- Keunggulan (beranda dan profil) ---- */
        $unggul = [
            [1, 'fa-trophy',          'Terakreditasi A',        'Terakreditasi A oleh BAN-S/M sebagai bukti mutu layanan pendidikan kami.'],
            [2, 'fa-chalkboard-user', 'Guru Berdedikasi',       'Tenaga pendidik yang sabar dan penuh perhatian dalam mendampingi setiap siswa.'],
            [3, 'fa-puzzle-piece',    'Kurikulum Merdeka',      'Pembelajaran berpusat pada kebutuhan dan potensi setiap siswa.'],
            [4, 'fa-seedling',        'Karakter dan Iman',      'Menanamkan iman, sopan santun, kejujuran, dan tanggung jawab dalam keseharian siswa.'],
            [5, 'fa-palette',         'Kegiatan Beragam',       'Kegiatan akademik dan non-akademik untuk mengembangkan bakat dan minat siswa.'],
            [6, 'fa-shield-halved',   'Lingkungan Aman',        'Suasana sekolah yang aman, nyaman, dan penuh kasih sayang bagi setiap siswa.'],
        ];
        foreach ($unggul as [$n, $ikon, $judul, $teks]) {
            $ubah('beranda_keunggulan', $n, compact('ikon', 'judul', 'teks'));
            $ubah('profil_keunggulan',  $n, compact('ikon', 'judul', 'teks'));
        }
        $ubah('profil_keunggulan', 6, [
            'ikon'  => 'fa-calendar-days',
            'judul' => 'Pengalaman Sejak 1968',
            'teks'  => 'Lebih dari lima dekade mendampingi anak-anak Sragen belajar dan bertumbuh.',
        ]);

        /* ---- FAQ ---- */
        $faq = [
            [1, 'Jenjang apa saja yang tersedia?', 'SD Santo Fransiskus menyelenggarakan pendidikan dasar dari kelas 1 sampai kelas 6.'],
            [2, 'Bagaimana cara mendaftar?', 'Hubungi sekolah melalui telepon 0271-890911 atau datang langsung ke sekolah. Kami akan menjelaskan persyaratan dan jadwal pendaftaran.'],
            [3, 'Kapan jam belajar di sekolah?', 'Kegiatan belajar berlangsung pagi hari, Senin sampai Sabtu. Untuk jam yang pasti, silakan hubungi sekolah.'],
            [4, 'Berapa biaya pendaftaran dan uang sekolah?', 'Untuk informasi biaya terbaru, silakan hubungi sekolah agar mendapat penjelasan yang akurat.'],
            [5, 'Apakah sekolah sudah terakreditasi?', 'Ya, SD Santo Fransiskus Sragen terakreditasi A oleh BAN-S/M.'],
            [6, 'Di mana lokasi sekolah?', 'Jalan Rokan No. 15, Sragen Tengah, Kecamatan Sragen, Kabupaten Sragen, Jawa Tengah 57211. Peta lengkap ada di halaman Hubungi Kami.'],
        ];
        foreach ($faq as [$n, $judul, $teks]) {
            $ubah('beranda_faq', $n, compact('judul', 'teks'));
        }

        /* ---- Kontak dan footer ---- */
        $atur = fn (string $kunci, string $nilai) =>
            DB::table('pengaturan')->updateOrInsert(['kunci' => $kunci], ['nilai' => $nilai]);

        $atur('kontak_alamat', 'Jalan Rokan No. 15, Sragen Tengah, Kecamatan Sragen, Kabupaten Sragen, Jawa Tengah 57211');
        $atur('kontak_telepon', '0271-890911');
        $atur('kontak_email', 'operator.sdsantofransiskus@gmail.com');
        $atur('footer_deskripsi', 'SD Santo Fransiskus Sragen mendampingi anak belajar dan bertumbuh dengan penuh kasih sejak 1968.');
    }
}