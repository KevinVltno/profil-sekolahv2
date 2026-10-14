<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="robots" content="noindex,nofollow">
<title>Login — SD Santo Fransiskus Sragen</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
<link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />
</head>
<body>

<div class="left-panel">
  <div class="left-brand">
    <div class="icon"><img src="{{ asset(atur('navbar_logo', 'img/logo.png')) }}" alt="Logo SD Santo Fransiskus"></div>
    <div class="brand-text"><strong>SD Santo Fransiskus Sragen</strong><span>Portal Admin Website</span></div>
  </div>
  <div class="left-content">
    <h2>Kelola Website<br>Sekolah dengan <span>mudah</span>.</h2>
    <p>Panel untuk mengelola konten Beranda, Profil Sekolah, Guru &amp; Staf, Fasilitas, Program, Berita, Kontak, Footer, dan Navbar.</p>
  </div>
  <div class="left-features">
    <div class="feature-item"><div class="feature-dot"><i class="fa-solid fa-newspaper" aria-hidden="true"></i></div><p>Berita &amp; pengumuman</p></div>
    <div class="feature-item"><div class="feature-dot"><i class="fa-solid fa-images" aria-hidden="true"></i></div><p>Galeri kegiatan</p></div>
    <div class="feature-item"><div class="feature-dot"><i class="fa-solid fa-trophy" aria-hidden="true"></i></div><p>Prestasi &amp; guru</p></div>
  </div>
</div>

<div class="right-panel">
  <div class="login-box">
    <h1>Login</h1>
    <p class="sub">Masuk sebagai admin atau guru untuk mengelola konten website sekolah.</p>

    @if ($errors->any())
      <div class="error-msg show"><span>{{ $errors->first() }}</span></div>
    @endif

    <form method="POST" action="{{ route('login.proses') }}">
      @csrf
      <div class="form-group">
        <label>Username</label>
        <div class="input-wrap"><input type="text" name="username" value="{{ old('username') }}" autocomplete="username" autofocus required></div>
      </div>
      <div class="form-group">
        <label>Password</label>
        <div class="input-wrap">
          <input type="password" name="password" id="password" autocomplete="current-password" required>
          <button type="button" class="toggle-eye" id="togglePass" aria-label="Lihat password">
            <svg viewBox="0 0 24 24" fill="none" width="18" height="18">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2"/>
              <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
            </svg>
          </button>
        </div>
      </div>
      <button class="btn-login" type="submit"><span class="btn-text">Masuk Sekarang</span><div class="spinner"></div></button>
    </form>

    <div class="divider">atau</div>
    <a href="{{ route('beranda') }}" class="btn-back">Kembali ke Website</a>
  </div>
</div>

<script>
document.getElementById('togglePass').addEventListener('click', () => {
  const i = document.getElementById('password');
  i.type = i.type === 'password' ? 'text' : 'password';
});
</script>
</body>
</html>