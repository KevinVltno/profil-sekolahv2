<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>{{ $pageTitle }} — Admin SD Santo Fransiskus</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />
</head>
<body>
@php
  $logo = atur('navbar_logo');
  $admin = auth('admin')->user();
  $menu = config('admin_menu');
  $grup = [];
  foreach ($menu['seksi'] as $k => $m) {
      if (! $admin->bolehKonten($k)) continue;
      $grup[$m['halaman']][] = [$m['ikon'], $m['judul'], route('admin.konten.index', $k), $k];
  }
  if ($admin->isAdmin()) {
      foreach ($menu['pengaturan'] as $k => $m) {
          $grup[$m['halaman']][] = [$m['ikon'], $m['judul'], route('admin.pengaturan.edit', $k), $k];
      }
  }
@endphp

<div class="mobile-topbar">
  <div class="mobile-topbar-brand">
    <div class="mobile-topbar-logo">SF</div>
    <div><div class="mobile-topbar-title">Admin Santo Fransiskus</div><div class="mobile-topbar-sub">Panel Manajemen</div></div>
  </div>
  <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()" aria-label="Menu"><span></span><span></span><span></span></button>
</div>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="sidebar-brand-top">
      @if ($logo)<img src="{{ asset($logo) }}" alt="">@else<div class="mobile-topbar-logo">SF</div>@endif
      <div><div class="sidebar-title">Admin Profil Sekolah</div><div class="sidebar-sub">Panel {{ $admin->isAdmin() ? 'Admin' : 'Guru' }}</div></div>
    </div>
  </div>
  <nav class="sidebar-nav">
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ $pageKey === 'dashboard' ? 'active' : '' }}"><span class="ic"><i class="fa-solid fa-chart-column" aria-hidden="true"></i></span> Dashboard</a>
    @foreach ($grup as $halaman => $items)
      <div class="nav-label">{{ $halaman }}</div>
      @foreach ($items as [$ic, $jd, $url, $k])
        <a href="{{ $url }}" class="nav-item {{ $pageKey === $k ? 'active' : '' }}"><span class="ic">{{ ikon($ic) }}</span> {{ $jd }}</a>
      @endforeach
    @endforeach
    <div class="nav-label">Lainnya</div>
    @if ($admin->isAdmin())
      <a href="{{ route('admin.guru.index') }}" class="nav-item {{ $pageKey === 'akun-guru' ? 'active' : '' }}"><span class="ic"><i class="fa-solid fa-user-gear" aria-hidden="true"></i></span> Akun Guru</a>
    @endif
    <a href="{{ route('admin.akun') }}" class="nav-item {{ $pageKey === 'akun' ? 'active' : '' }}"><span class="ic"><i class="fa-solid fa-key" aria-hidden="true"></i></span> Ganti Password</a>
    <a href="{{ route('beranda') }}" target="_blank" class="nav-item"><span class="ic"><i class="fa-solid fa-globe" aria-hidden="true"></i></span> Lihat Website</a>
  </nav>
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-avatar">{{ Str::upper(Str::substr($admin->username, 0, 1)) }}</div>
      <div><div class="sidebar-username">{{ $admin->nama }}</div><div class="sidebar-role">{{ $admin->isAdmin() ? 'Administrator' : 'Guru' }}</div></div>
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="btn-logout" style="width:100%;border:0;cursor:pointer;font:inherit"><i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> Keluar</button>
    </form>
  </div>
</aside>

<main class="main">
  <div class="breadcrumb"><a href="{{ route('admin.dashboard') }}">Dashboard</a> @if ($pageKey !== 'dashboard')<span>/</span> <span>{{ $pageTitle }}</span>@endif</div>
  <div class="topbar">
    <div class="topbar-title"><h1>{{ $pageTitle }}</h1><p>{{ $pageDesc }}</p></div>
  </div>

  @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
  @if ($errors->any())<div class="alert alert-error">{{ $errors->first() }}</div>@endif

  @yield('content')
</main>

<script>
function toggleSidebar(){
  const s=document.querySelector('.sidebar'),o=document.getElementById('sidebarOverlay'),b=document.getElementById('hamburgerBtn');
  const open=s.classList.toggle('open'); o.classList.toggle('show',open); b.classList.toggle('open',open);
  document.body.style.overflow=open?'hidden':'';
}
function closeSidebar(){
  document.querySelector('.sidebar').classList.remove('open');
  document.getElementById('sidebarOverlay').classList.remove('show');
  document.getElementById('hamburgerBtn').classList.remove('open');
  document.body.style.overflow='';
}
window.addEventListener('resize', () => { if (window.innerWidth > 768) closeSidebar(); });
</script>
@stack('scripts')
</body>
</html>