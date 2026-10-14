<article class="news-card reveal">
  <a href="{{ route('berita.show', $b) }}"><img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" loading="lazy" /></a>
  <div class="news-body">
    <div class="news-meta"><i class="fa-solid fa-calendar-days" aria-hidden="true"></i> {{ tanggal_id($b->tanggal) }}</div>
    <h3>{{ $b->judul }}</h3>
    <p>{{ Str::limit((string) $b->teks, 160) }}</p>
    <a href="{{ route('berita.show', $b) }}" class="btn btn-blue btn-sm">Baca Selengkapnya</a>
  </div>
</article> 