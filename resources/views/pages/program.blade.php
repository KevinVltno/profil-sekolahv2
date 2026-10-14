@extends('layouts.app')
@section('title', 'Program | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Program',
    'title' => 'Program Kami',
    'desc'  => 'Dirancang untuk mengoptimalkan potensi setiap siswa secara menyeluruh.',
  ])

  @php
    // Jenjang kelas masih statis (tidak diambil dari database)
    $jenjang = collect([
      ['img/keg2.jpg', 'Kelas Rendah (Kelas 1–3)', 'Siswa dikenalkan pada budaya belajar di sekolah dasar, dengan penguatan membaca, menulis, berhitung, dan kebiasaan baik sehari-hari.'],
      ['img/keg3.jpg', 'Kelas Tinggi (Kelas 4–6)', 'Siswa mengembangkan kemampuan berpikir, kemandirian, dan tanggung jawab sebagai persiapan melanjutkan ke jenjang berikutnya.'],
    ])->map(fn ($j) => (object) ['gambar' => $j[0], 'judul' => $j[1], 'teks' => $j[2]]);
  @endphp

  <section>
    <div class="inner">
      <div class="head center reveal"><span class="eyebrow">Jenjang</span><h2 class="title">Jenjang Kelas</h2></div>
      @include('partials.fas-list', ['items' => $jenjang])
    </div>
  </section>

  <section class="bg-soft">
    <div class="inner">
      <div class="head center reveal"><span class="eyebrow">Pembelajaran</span><h2 class="title">Program Unggulan</h2></div>
      @include('partials.fas-list', ['items' => $items])
    </div>
  </section>
@endsection