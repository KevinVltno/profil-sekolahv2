@extends('layouts.app')
@section('title', 'Hubungi Kami | SD Santo Fransiskus Sragen')

@section('content')
  @include('partials.page-header', [
    'crumb' => 'Hubungi Kami',
    'title' => 'Hubungi Kami',
    'desc'  => 'Kami siap menyambut putra-putri Anda. Hubungi kami untuk informasi pendaftaran.',
  ])

  <section>
    <div class="inner">
      <div class="kontak reveal">
        <div class="k-box">
          <div class="k-row"><div class="k-ic"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></div><div><label>Alamat</label><p>{!! nl2br(e(atur('kontak_alamat'))) !!}</p></div></div>
          <div class="k-row"><div class="k-ic"><i class="fa-solid fa-phone" aria-hidden="true"></i></div><div><label>Telepon / WhatsApp</label><p>{{ atur('kontak_telepon') }}</p></div></div>
          <div class="k-row"><div class="k-ic"><i class="fa-solid fa-envelope" aria-hidden="true"></i></div><div><label>Email</label><p>{{ atur('kontak_email') }}</p></div></div>
          <div class="k-row"><div class="k-ic"><i class="fa-solid fa-clock" aria-hidden="true"></i></div><div><label>Jam Operasional</label><p>{{ atur('kontak_jam') }}</p></div></div>
          @if (atur('kontak_whatsapp'))
          <a class="btn btn-white" target="_blank" rel="noopener" href="{{ wa_link() }}">Chat WhatsApp</a>
          @endif
        </div>
        <div class="map">
          @if (atur('kontak_gmaps'))
          <iframe loading="lazy" allowfullscreen title="Lokasi sekolah" src="{{ atur('kontak_gmaps') }}" style="border:0;width:100%;height:100%"></iframe>
          @endif
        </div>
      </div>

      <form class="form-card reveal" id="waForm">
        <h3>Kirim Pesan via WhatsApp</h3>
        <div class="form-row">
          <div><label for="nama">Nama</label><input type="text" id="nama" name="nama" placeholder="Nama orang tua / wali" required /></div>
          <div><label for="hp">No. HP</label><input type="tel" id="hp" name="hp" placeholder="08xxxxxxxxxx" required /></div>
        </div>
        <label for="pesan">Pesan</label>
        <textarea id="pesan" name="pesan" placeholder="Tulis pertanyaan Anda..." required></textarea>
        <button type="submit" class="btn btn-blue">Kirim ke WhatsApp</button>
      </form>

      <div class="sosmed reveal">
        @foreach (['kontak_ig' => 'Instagram', 'kontak_fb' => 'Facebook', 'kontak_yt' => 'YouTube', 'kontak_tt' => 'TikTok'] as $k => $nama)
          @if (atur($k))<a class="btn btn-blue" href="{{ atur($k) }}" target="_blank" rel="noopener">{{ $nama }}</a>@endif
        @endforeach
      </div>
    </div>
  </section>
@endsection