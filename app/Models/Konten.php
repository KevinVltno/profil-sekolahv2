<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $table = 'konten';
    public $timestamps = false;

    protected $fillable = [
        'seksi', 'gambar', 'ikon', 'judul', 'teks', 'teks2',
        'bintang', 'tanggal', 'tahun', 'urutan',
    ];

    protected function casts(): array
    {
        return ['tanggal' => 'date:Y-m-d', 'bintang' => 'integer', 'urutan' => 'integer'];
    }

    // Berita urut terbaru, seksi lain urut sesuai kolom "urutan"
    public function scopeSeksi(Builder $q, string $seksi): Builder
    {
        $q->where('seksi', $seksi);

        return $seksi === 'berita'
            ? $q->orderByDesc('tanggal')->orderByDesc('id')
            : $q->orderBy('urutan')->orderBy('id');
    }

    public static function satu(string $seksi): ?self
    {
        return static::seksi($seksi)->first();
    }

    // Pecah teks menjadi paragraf (satu baris = satu paragraf)
    public function paragraf(): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $this->teks))));
    }
}