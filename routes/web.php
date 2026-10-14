<?php

use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\AkunGuruController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\HalamanController;
use Illuminate\Support\Facades\Route;

/* ---------- Halaman publik ---------- */
Route::controller(HalamanController::class)->group(function () {
    Route::get('/', 'beranda')->name('beranda');
    Route::get('/profil-sekolah', 'profil')->name('profil');
    Route::get('/profil-guru', 'guru')->name('guru');
    Route::get('/fasilitas', 'fasilitas')->name('fasilitas');
    Route::get('/program', 'program')->name('program');
    Route::get('/berita', 'berita')->name('berita.index');
    Route::get('/berita/{konten}', 'beritaDetail')->name('berita.show');
    Route::get('/galeri', 'galeri')->name('galeri');
    Route::get('/kontak', 'kontak')->name('kontak');
});

/* ---------- Login (admin dan guru memakai halaman yang sama) ---------- */
Route::middleware('guest:admin')->group(function () {
    Route::get('/backend-admin/login', [AuthController::class, 'form'])->name('login');
    Route::post('/backend-admin/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.proses');
});

/* ---------- Panel (admin dan guru) ---------- */
Route::prefix('backend-admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Konten: guru dibatasi per seksi di KontenController
    Route::get('konten/{s}', [KontenController::class, 'index'])->name('konten.index');
    Route::post('konten/{s}', [KontenController::class, 'store'])->name('konten.store');
    Route::put('konten/{s}/{konten}', [KontenController::class, 'update'])->name('konten.update');
    Route::delete('konten/{s}/{konten}', [KontenController::class, 'destroy'])->name('konten.destroy');

    Route::get('akun', [AkunController::class, 'form'])->name('akun');
    Route::post('akun', [AkunController::class, 'update'])->name('akun.update');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    /* ---------- Khusus admin ---------- */
    Route::middleware('peran:admin')->group(function () {
        Route::get('pengaturan/{s}', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
        Route::post('pengaturan/{s}', [PengaturanController::class, 'update'])->name('pengaturan.update');

        Route::get('akun-guru', [AkunGuruController::class, 'index'])->name('guru.index');
        Route::post('akun-guru', [AkunGuruController::class, 'store'])->name('guru.store');
        Route::put('akun-guru/{akun}', [AkunGuruController::class, 'update'])->name('guru.update');
        Route::delete('akun-guru/{akun}', [AkunGuruController::class, 'destroy'])->name('guru.destroy');
    });
});