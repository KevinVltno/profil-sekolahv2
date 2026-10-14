<div class="topbar">
  <span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> {{ atur('kontak_alamat', 'Jalan Rokan No. 15 Sragen Tengah, Sragen') }}</span>
  <span><i class="fa-solid fa-phone" aria-hidden="true"></i> {{ atur('kontak_telepon') }} &nbsp;|&nbsp; <i class="fa-solid fa-envelope" aria-hidden="true"></i> {{ atur('kontak_email') }}</span>
</div>

<div class="nav-wrap">
  <nav class="navbar">
    <a href="{{ route('beranda') }}" class="brand">
      <img src="{{ asset(atur('navbar_logo', 'img/logo.png')) }}" alt="Logo SD Santo Fransiskus" />
      <div>SD Santo Fransiskus<small>Sragen · Sejak 1968</small></div>
    </a>

    <ul class="menu">
      <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
      <li class="has-dd">
        <button type="button" class="{{ request()->routeIs('profil', 'guru') ? 'active' : '' }}" aria-haspopup="true">
          Profil Sekolah
          <svg class="caret" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <ul class="dropdown">
          <li><a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Tentang Sekolah</a></li>
          <li><a href="{{ route('guru') }}" class="{{ request()->routeIs('guru') ? 'active' : '' }}">Profil Guru &amp; Staff</a></li>
        </ul>
      </li>
      <li><a href="{{ route('fasilitas') }}" class="{{ request()->routeIs('fasilitas') ? 'active' : '' }}">Fasilitas</a></li>
      <li><a href="{{ route('program') }}" class="{{ request()->routeIs('program') ? 'active' : '' }}">Program</a></li>
      <li><a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'active' : '' }}">Berita</a></li>
      <li><a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Hubungi Kami</a></li>
    </ul>

    <a class="nav-cta" target="_blank" rel="noopener" href="{{ wa_link() }}">Daftar Sekarang</a>
    <button class="hamburger" id="hamburger" aria-label="Menu"><span></span><span></span><span></span></button>
  </nav>

  <div class="mobile" id="mobile">
    <a href="{{ route('beranda') }}">Beranda</a>
    <button class="m-dd" id="mDd" type="button">Profil Sekolah <span>▾</span></button>
    <div class="m-sub {{ request()->routeIs('profil', 'guru') ? 'open' : '' }}" id="mSub">
      <a href="{{ route('profil') }}">Tentang Sekolah</a>
      <a href="{{ route('guru') }}">Profil Guru &amp; Staff</a>
    </div>
    <a href="{{ route('fasilitas') }}">Fasilitas</a>
    <a href="{{ route('program') }}">Program</a>
    <a href="{{ route('berita.index') }}">Berita</a>
    <a href="{{ route('kontak') }}">Hubungi Kami</a>
    <a class="m-cta" target="_blank" rel="noopener" href="{{ wa_link() }}">Daftar Sekarang →</a>
  </div>
</div>