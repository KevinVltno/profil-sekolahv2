@extends('layouts.app')
@section('title', 'Profil Sekolah | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Profil Sekolah / Tentang Sekolah',
    'title' => 'Tentang Sekolah',
    'desc'  => 'Mengenal sejarah dan semangat SD Santo Fransiskus Sragen.',
  ])

  @if ($sejarah)
  <section>
    <div class="inner about">
      <div class="about-img reveal"><img src="{{ asset($sejarah->gambar ?: 'img/gedung.jpg') }}" alt="{{ $sejarah->judul }}" /></div>
      <div class="reveal">
        <span class="eyebrow">Profil &amp; Sejarah</span>
        <h2 class="title">{{ $sejarah->judul }}</h2>
        <p>{!! nl2br(e((string) $sejarah->teks)) !!}</p>
      </div>
    </div>
  </section>
  @endif

  <section class="bg-soft">
    <div class="inner">
      <div class="head center reveal"><span class="eyebrow">Kenapa Kami</span><h2 class="title">Keunggulan Sekolah</h2></div>
      <div class="unggul-grid">
        @foreach ($keunggulan as $k)
        <div class="unggul-card reveal">
          <div class="unggul-ic">{{ ikon($k->ikon) }}</div>
          <h3>{{ $k->judul }}</h3>
          <p>{{ $k->teks }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section>
    <div class="inner">
      <div class="head center reveal"><span class="eyebrow">Di Luar Kelas</span><h2 class="title">Ekstrakurikuler</h2></div>
      <div class="ekskul-grid">
        @foreach ($ekskul as $x)
        <div class="ekskul-card reveal">
          <img src="{{ asset($x->gambar) }}" alt="{{ $x->judul }}" loading="lazy" />
          <div><h3>{{ $x->judul }}</h3></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-soft">
    <div class="inner">
      <div class="head center reveal"><span class="eyebrow">Capaian</span><h2 class="title">Prestasi Sekolah</h2></div>
      <div class="prestasi-grid">
        @foreach ($prestasi as $p)
        <div class="prestasi-card reveal">
          <div class="prestasi-img">
            <img src="{{ asset($p->gambar) }}" alt="{{ $p->judul }}" loading="lazy" />
            @if ($p->tahun)<span class="prestasi-year">{{ $p->tahun }}</span>@endif
            @if ($p->ikon)<span class="prestasi-medal">{{ ikon($p->ikon) }}</span>@endif
          </div>
          <div class="prestasi-info"><h3>{{ $p->judul }}</h3><p>{{ $p->teks2 }}</p></div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section>
    <div class="inner">
      <div class="head center reveal"><span class="eyebrow">Arah Kami</span><h2 class="title">Visi &amp; Misi</h2></div>
      <div class="vm-wrap reveal">
        <div class="vm-visi"><span class="vm-label">Visi</span><p>{{ $visi }}</p></div>
        <div class="vm-misi">
          <span class="vm-label">Misi</span>
          <ol>
            @foreach ($misi as $n => $m)
            <li><b>{{ $n + 1 }}</b><span>{{ $m }}</span></li>
            @endforeach
          </ol>
        </div>
      </div>
    </div>
  </section>
@endsection