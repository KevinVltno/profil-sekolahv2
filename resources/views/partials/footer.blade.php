<footer>
  <div class="f-top">
    <div>
      <img src="{{ asset(atur('footer_logo', 'img/logo.png')) }}" alt="Logo" />
      <p>{{ atur('footer_deskripsi', 'SD Santo Fransiskus Sragen mendampingi anak belajar dan bertumbuh dengan penuh kasih.') }}</p>
    </div>
    <div>
      <h4>Menu</h4>
      <a href="{{ route('beranda') }}">Beranda</a>
      <a href="{{ route('profil') }}">Tentang Sekolah</a>
      <a href="{{ route('guru') }}">Guru &amp; Staff</a>
      <a href="{{ route('fasilitas') }}">Fasilitas</a>
      <a href="{{ route('program') }}">Program</a>
      <a href="{{ route('berita.index') }}">Berita</a>
      <a href="{{ route('kontak') }}">Hubungi Kami</a>
    </div>
    <div>
      <h4>Ikuti Kami</h4>
      @foreach (['footer_ig' => 'Instagram', 'footer_fb' => 'Facebook', 'footer_yt' => 'YouTube', 'footer_tt' => 'TikTok'] as $kunci => $nama)
        @if (atur($kunci))
          <a href="{{ atur($kunci) }}" target="_blank" rel="noopener">{{ $nama }}</a>
        @endif
      @endforeach
    </div>
  </div>
  <div class="copy">© {{ date('Y') }} SD Santo Fransiskus Sragen. Hak cipta dilindungi.</div>
</footer>