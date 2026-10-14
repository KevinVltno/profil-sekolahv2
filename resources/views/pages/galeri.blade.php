@extends('layouts.app')
@section('title', 'Galeri | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Galeri',
    'title' => 'Galeri Kegiatan',
    'desc'  => 'Momen keseruan siswa di SD Santo Fransiskus. Klik foto untuk memperbesar.',
  ])
  <section><div class="inner"><div class="gal-grid" id="galAll"></div></div></section>
@endsection

@push('scripts')
<script>const GALERI = @json($galeri);</script>
<script src="{{ asset('js/galeri.js') }}"></script>
@endpush