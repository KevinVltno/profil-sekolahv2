<div class="fas-list">
  @foreach ($items as $i => $f)
  <div class="fas-row {{ $i % 2 ? 'reverse ' : '' }}reveal">
    <div class="fas-media">
      <img src="{{ asset($f->gambar) }}" alt="{{ $f->judul }}" />
      <button type="button" class="fas-btn">Lihat detail <span>&rarr;</span></button>
      <div class="fas-panel">
        <h4>{{ $f->judul }}</h4>
        <p>{!! nl2br(e((string) $f->teks)) !!}</p>
        <button type="button" class="fas-close" aria-label="Tutup">&times;</button>
      </div>
    </div>
    <h2 class="fas-title">{{ $f->judul }}</h2>
  </div>
  @endforeach
</div>