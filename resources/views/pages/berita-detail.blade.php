@extends('layouts.app')
@section('title', $b->judul . ' | SD Santo Fransiskus Sragen')

@section('content')
  <section class="detail-section">
    <div class="inner">
      <div class="crumb crumb-dark">
        <a href="{{ route('beranda') }}">Beranda</a> / <a href="{{ route('berita.index') }}">Berita</a> / Detail
      </div>
      <div class="detail-wrap">
        <article class="artikel">
          <div class="artikel-meta">
            <span><i class="fa-solid fa-user" aria-hidden="true"></i> Admin</span>
            <span><i class="fa-solid fa-calendar-days" aria-hidden="true"></i> {{ tanggal_id($b->tanggal) }}</span>
          </div>
          <h1 class="artikel-title">{{ $b->judul }}</h1>
          <img class="artikel-img" src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" />
          <div class="artikel-isi">
            @foreach ($b->paragraf() as $p)<p>{{ $p }}</p>@endforeach
          </div>
          <div class="artikel-share">
            <span>Bagikan:</span>
            <a class="btn btn-blue btn-sm" target="_blank" rel="noopener"
               href="https://wa.me/?text={{ rawurlencode($b->judul . ' ' . url()->current()) }}">WhatsApp</a>
          </div>
          <a href="{{ route('berita.index') }}" class="more">← Kembali ke semua berita</a>
        </article>

        <aside class="sidebar">
          <div class="side-box">
            <h3 class="side-title">Berita Terkini</h3>
            @foreach ($terkini as $x)
            <a class="side-item" href="{{ route('berita.show', $x) }}">
              <img src="{{ asset($x->gambar) }}" alt="" loading="lazy" />
              <span>{{ $x->judul }}</span>
            </a>
            @endforeach
          </div>
        </aside>
      </div>
    </div>
  </section>
@endsection