(function () {
  if (typeof BERITA === 'undefined') return;

  const link = id => `berita-detail.php?id=${id}`;

  // Kartu berita (dipakai di beranda & halaman berita)
  const card = b => `
    <article class="news-card reveal">
      <a href="${link(b.id)}"><img src="${b.gambar}" alt="${b.judul}" loading="lazy" /></a>
      <div class="news-body">
        <div class="news-meta"><i class="fa-solid fa-calendar-days" aria-hidden="true"></i> ${b.tanggal}</div>
        <h3>${b.judul}</h3>
        <p>${b.ringkasan}</p>
        <a href="${link(b.id)}" class="btn btn-blue btn-sm">Baca Selengkapnya</a>
      </div>
    </article>`;

  // Beranda: 3 berita terkini
  const latest = document.getElementById('newsLatest');
  if (latest) latest.innerHTML = BERITA.slice(0, 3).map(card).join('');

  // Halaman Berita: semua berita
  const all = document.getElementById('newsAll');
  if (all) all.innerHTML = BERITA.map(card).join('');

  // Halaman Detail Berita
  const detail = document.getElementById('detail');
  if (detail) {
    const id = Number(new URLSearchParams(location.search).get('id')) || BERITA[0].id;
    const b = BERITA.find(x => x.id === id);

    if (!b) {
      detail.innerHTML = `<div class="empty">Berita tidak ditemukan.<br><a href="berita.php" class="more">← Kembali ke daftar berita</a></div>`;
      return;
    }

    document.title = `${b.judul} | SD Santo Fransiskus`;

    const sideList = list => list.map(x => `
      <a class="side-item" href="${link(x.id)}">
        <img src="${x.gambar}" alt="" loading="lazy" />
        <span>${x.judul}</span>
      </a>`).join('');

    const pilihan = BERITA.filter(x => x.pilihan).slice(0, 4);

    detail.innerHTML = `
      <article class="artikel">
        <div class="artikel-meta"><span><i class="fa-solid fa-user" aria-hidden="true"></i> ${b.penulis}</span><span><i class="fa-solid fa-calendar-days" aria-hidden="true"></i> ${b.tanggal}</span></div>
        <h1 class="artikel-title">${b.judul}</h1>
        <img class="artikel-img" src="${b.gambar}" alt="${b.judul}" />
        <div class="artikel-isi">${b.isi.map(p => `<p>${p}</p>`).join('')}</div>
        <div class="artikel-share">
          <span>Bagikan:</span>
          <a class="btn btn-blue btn-sm" target="_blank" rel="noopener"
             href="https://wa.me/?text=${encodeURIComponent(b.judul + ' ' + location.href)}">WhatsApp</a>
        </div>
        <a href="berita.php" class="more">← Kembali ke semua berita</a>
      </article>

      <aside class="sidebar">
        <div class="side-box">
          <h3 class="side-title">Berita Terkini</h3>
          ${sideList(BERITA.slice(0, 4))}
        </div>
        ${pilihan.length ? `
        <div class="side-box">
          <h3 class="side-title">Berita Pilihan</h3>
          ${sideList(pilihan)}
        </div>` : ''}
      </aside>`;
  }
})();