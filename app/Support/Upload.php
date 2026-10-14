<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Upload
{
    const DIR = 'img/uploads';

    // Simpan gambar (sudah divalidasi di controller), kembalikan path relatif dari public/
    public static function simpan(UploadedFile $file): string
    {
        File::ensureDirectoryExists(public_path(self::DIR));
        $nama = Str::random(16) . '.' . $file->guessExtension();
        $file->move(public_path(self::DIR), $nama);

        return self::DIR . '/' . $nama;
    }

    // Hanya menghapus file di img/uploads/, gambar bawaan situs tidak pernah disentuh
    public static function hapus(?string $path): void
    {
        if ($path && str_starts_with($path, self::DIR . '/')) {
            File::delete(public_path(self::DIR . '/' . basename($path)));
        }
    }
}