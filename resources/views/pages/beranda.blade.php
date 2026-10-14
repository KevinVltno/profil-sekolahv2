@extends('layouts.app')
@section('title', 'Beranda | SD Santo Fransiskus Sragen')

@section('content')
  <section id="beranda">
    <div class="hero">
      <div>
        <div class="badge"><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i> Penerimaan Siswa Baru</div>
        <h1>Tumbuh &amp; Berkembang<br><span>Bersama Santo Fransiskus</span></h1>
        <p>Sekolah dasar Katolik di Sragen yang mendampingi anak belajar dalam lingkungan yang menyenangkan, aman, dan penuh kasih sayang.</p>
        <div class="hero-btns">
          <a class="btn btn-white" target="_blank" rel="noopener" href="{{ wa_link() }}">Daftar via WhatsApp</a>
          <a class="btn btn-ghost" href="{{ route('profil') }}">Kenali Kami</a>
        </div>
      </div>
      <div class="hero-img">
        <img src="{{ asset($tumbuh->gambar ?? 'img/gedung.jpg') }}" alt="Logo SD Santo Fransiskus" />
      </div>
    </div>
    <div class="wave"><svg viewBox="0 0 1440 60" preserveAspectRatio="none" width="100%" height="60"><path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#ffffff"/></svg></div>
  </section>

  <div class="stats reveal">
    <div class="stats-grid">
      <div class="stat"><b>1968</b><span>Tahun Berdiri</span></div>
      <div class="stat"><b>A</b><span>Akreditasi BAN-S/M</span></div>
      <div class="stat"><b>1–6</b><span>Jenjang Kelas</span></div>
      <div class="stat"><b>6 Hari</b><span>Senin – Sabtu</span></div>
    </div>
  </div>

  @if ($sejarah)
  <section>
    <div class="inner about">
      <div class="about-img reveal"><img src="{{ asset($sejarah->gambar ?: 'img/keg1.jpg') }}" alt="{{ $sejarah->judul }}" /></div>
      <div class="reveal">
        <span class="eyebrow">Sejarah Sekolah</span>
        <h2 class="title">{{ $sejarah->judul }}</h2>
        <p>{!! nl2br(e((string) $sejarah->teks)) !!}</p>
        <a href="{{ route('profil') }}" class="btn btn-blue">Pelajari Selengkapnya →</a>
      </div>
    </div>
  </section>
  @endif

  <section class="bg-soft">
    <div class="inner">
      <div class="head center reveal">
        <span class="eyebrow">Keunggulan</span>
        <h2 class="title">Mengapa Memilih Santo Fransiskus?</h2>
        <p class="desc">Alasan orang tua mempercayakan buah hatinya kepada kami.</p>
      </div>
      <div class="prog-grid">
        @foreach ($keunggulan as $k)
        <div class="prog-card reveal"><div class="prog-icon">{{ ikon($k->ikon) }}</div><h3>{{ $k->judul }}</h3><p>{{ $k->teks }}</p></div>
        @endforeach
      </div>
    </div>
  </section>

  <section>
    <div class="inner">
      <div class="head center reveal">
        <span class="eyebrow">Berita Terkini</span>
        <h2 class="title">Kabar Terbaru dari Santo Fransiskus</h2>
        <p class="desc">Informasi kegiatan, prestasi, dan pengumuman terbaru dari sekolah.</p>
      </div>
      <div class="news-grid">
        @foreach ($berita as $b) @include('partials.news-card', ['b' => $b]) @endforeach
      </div>
      <div class="center-btn reveal"><a href="{{ route('berita.index') }}" class="btn btn-blue">Lihat Semua Berita</a></div>
    </div>
  </section>

  <section class="bg-soft">
    <div class="inner">
      <div class="head center reveal">
        <span class="eyebrow">Galeri</span>
        <h2 class="title">Momen Keseruan Bersama</h2>
        <p class="desc">Sekilas kegiatan seru siswa di SD Santo Fransiskus.</p>
      </div>
      <div class="gal-mosaic" id="galMosaic"></div>
      <div class="center-btn reveal"><a href="{{ route('galeri') }}" class="btn btn-blue">Lihat Semua</a></div>
    </div>
  </section>

  <section>
    <div class="inner">
      <div class="head center reveal">
        <span class="eyebrow">Testimonial</span>
        <h2 class="title">Kata Orang Tua Murid</h2>
        <p class="desc">Pengalaman orang tua yang telah mempercayakan putra-putrinya kepada kami.</p>
      </div>
      <div class="testi-grid">
        @foreach ($testimoni as $ts)
        <div class="testi-card reveal">
          <div class="stars">{{ str_repeat('★', max(1, $ts->bintang)) }}</div>
          <p>{{ $ts->teks }}</p>
          <div class="testi-who">
            <div class="testi-av">
              @if ($ts->gambar)
                <img src="{{ asset($ts->gambar) }}" alt="" style="width:100%;height:100%;border-radius:50%;object-fit:cover">
              @else
                {{ Str::upper(Str::substr($ts->judul, 0, 1)) }}
              @endif
            </div>
            <div><b>{{ $ts->judul }}</b><span>{{ $ts->teks2 }}</span></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-soft">
    <div class="inner">
      <div class="head center reveal">
        <span class="eyebrow">FAQ</span>
        <h2 class="title">Pertanyaan yang Sering Ditanyakan</h2>
        <p class="desc">Jawaban singkat untuk pertanyaan yang paling sering diajukan orang tua.</p>
      </div>
      <div class="faq reveal">
        @foreach ($faq as $i => $f)
        <details @if ($i === 0) open @endif>
          <summary>{{ $f->judul }}</summary>
          <p>{!! nl2br(e((string) $f->teks)) !!}</p>
        </details>
        @endforeach
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>const GALERI = @json($galeri);</script>
<script src="{{ asset('js/galeri.js') }}"></script>
@endpush