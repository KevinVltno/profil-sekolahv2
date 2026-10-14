@extends('layouts.app')
@section('title', 'Profil Guru & Staff | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Profil Sekolah / Guru & Staff',
    'title' => 'Profil Guru & Staff',
    'desc'  => 'Tenaga pendidik berpengalaman dan berdedikasi untuk mendampingi siswa belajar dan bertumbuh.',
  ])

  <section>
    <div class="inner">
      @if ($bersama)
      <figure class="guru-bersama reveal">
        <img src="{{ asset($bersama->gambar) }}" alt="{{ $bersama->judul }}" loading="lazy" />
        <figcaption><b>{{ $bersama->judul }}</b><span>{{ $bersama->teks2 }}</span></figcaption>
      </figure>
      @endif

      <div class="guru-grid">
        @foreach ($staf as $g)
        <div class="guru-card reveal">
          <img src="{{ asset($g->gambar) }}" alt="{{ $g->judul }}" />
          <div class="guru-info">
            <h3>{{ $g->judul }}</h3>
            <span class="role">{{ $g->teks2 }}</span>
            @if (trim((string) $g->teks))<p>{{ $g->teks }}</p>@endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection