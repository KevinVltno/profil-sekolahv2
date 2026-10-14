@extends('admin.layout')

@section('content')
<div class="stat-grid">
  @foreach (config('admin_menu.seksi') as $k => $m)
    @if (auth('admin')->user()->bolehKonten($k))
    <a class="stat-card" href="{{ route('admin.konten.index', $k) }}">
      <span class="ic">{{ ikon($m['ikon']) }}</span>
      <b>{{ (int) ($jumlah[$k] ?? 0) }}</b>
      <span>{{ $m['halaman'] }} · {{ $m['judul'] }}</span>
    </a>
    @endif
  @endforeach
</div>

<div class="card" style="margin-top:20px">
  <div class="card-header"><h2>Berita Terkini di Beranda (otomatis dari menu Berita)</h2></div>
  <div class="card-body">
    @forelse ($terbaru as $b)
      <p style="font-size:.9rem;margin-bottom:6px"><strong>{{ $b->judul }}</strong> <span class="item-meta">· {{ $b->tanggal?->format('d-m-Y') }}</span></p>
    @empty
      <p class="empty-state">Belum ada berita. <a href="{{ route('admin.konten.index', 'berita') }}">Tambah berita →</a></p>
    @endforelse
  </div>
</div>
@endsection