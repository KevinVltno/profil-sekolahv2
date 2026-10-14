@extends('layouts.app')
@section('title', 'Berita | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Berita',
    'title' => 'Berita & Kegiatan',
    'desc'  => 'Informasi kegiatan, prestasi, dan pengumuman sekolah.',
  ])
  <section>
    <div class="inner">
      <div class="news-grid">
        @foreach ($berita as $b) @include('partials.news-card', ['b' => $b]) @endforeach
      </div>
    </div>
  </section>
@endsection