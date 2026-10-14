<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // "role" sengaja tidak di-fillable agar tidak bisa diubah lewat form
    protected $fillable = ['username', 'password', 'nama'];
    protected $hidden   = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Admin boleh semua seksi, guru hanya seksi di config admin_menu.seksi_guru
    public function bolehKonten(string $seksi): bool
    {
        return $this->isAdmin() || in_array($seksi, config('admin_menu.seksi_guru', []), true);
    }
}