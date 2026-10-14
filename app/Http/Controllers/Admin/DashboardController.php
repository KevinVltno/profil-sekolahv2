<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konten;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'jumlah'    => Konten::selectRaw('seksi, COUNT(*) as total')->groupBy('seksi')->pluck('total', 'seksi'),
            'terbaru'   => Konten::seksi('berita')->limit(3)->get(),
            'pageKey'   => 'dashboard',
            'pageTitle' => 'Dashboard',
            'pageDesc'  => 'Ringkasan konten website sekolah.',
        ]);
    }
}