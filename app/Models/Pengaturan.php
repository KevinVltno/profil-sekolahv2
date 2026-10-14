<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'kunci';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['kunci', 'nilai'];

    // Semua pengaturan sebagai array kunci => nilai (di-cache selama 1 request)
    public static function semua(): array
    {
        static $cache = null;

        return $cache ??= static::pluck('nilai', 'kunci')->all();
    }
}