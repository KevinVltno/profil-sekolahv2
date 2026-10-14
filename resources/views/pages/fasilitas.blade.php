@extends('layouts.app')
@section('title', 'Fasilitas | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Fasilitas',
    'title' => 'Fasilitas Sekolah',
    'desc'  => 'Sarana yang mendukung siswa belajar, bermain, dan berkreasi setiap hari.',
  ])
  <section><div class="inner">@include('partials.fas-list', ['items' => $items])</div></section>
@endsection