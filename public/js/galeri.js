(function () {
  if (typeof GALERI === 'undefined') return;

  // Keterangan foto: pakai "ket" kalau ada, kalau tidak pakai "alt"
  const ket = g => g.ket || g.alt || '';

  /* ============ LIGHTBOX (foto besar) ============ */
  const lb = document.createElement('div');
  lb.className = 'lb';
  lb.innerHTML = `
    <button class="lb-close" aria-label="Tutup">✕</button>
    <button class="lb-nav lb-prev" aria-label="Sebelumnya">‹</button>
    <img class="lb-img" alt="" />
    <button class="lb-nav lb-next" aria-label="Berikutnya">›</button>
    <div class="lb-cap"></div>
    <div class="lb-count"></div>`;
  document.body.appendChild(lb);

  const lbImg = lb.querySelector('.lb-img');
  const lbCap = lb.querySelector('.lb-cap');
  const lbCount = lb.querySelector('.lb-count');
  let cur = 0;

  function show(i) {
    cur = (i + GALERI.length) % GALERI.length;
    lbImg.src = GALERI[cur].src;
    lbImg.alt = GALERI[cur].alt || '';
    lbCap.textContent = ket(GALERI[cur]);
    lbCount.textContent = `${cur + 1} / ${GALERI.length}`;
  }
  function openLb(i) { show(i); lb.classList.add('open'); document.body.style.overflow = 'hidden'; }
  function closeLb() { lb.classList.remove('open'); document.body.style.overflow = ''; }

  lb.querySelector('.lb-close').addEventListener('click', closeLb);
  lb.querySelector('.lb-prev').addEventListener('click', () => show(cur - 1));
  lb.querySelector('.lb-next').addEventListener('click', () => show(cur + 1));
  lb.addEventListener('click', e => { if (e.target === lb) closeLb(); });
  document.addEventListener('keydown', e => {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeLb();
    if (e.key === 'ArrowLeft') show(cur - 1);
    if (e.key === 'ArrowRight') show(cur + 1);
  });

  /* ============ HALAMAN GALERI: SEMUA FOTO ============ */
  const grid = document.getElementById('galAll');
  if (grid) {
    grid.innerHTML = GALERI.map((g, i) => `
      <div class="gal-item reveal" data-i="${i}">
        <img src="${g.src}" alt="${g.alt || ''}" loading="lazy" />
        ${ket(g) ? `<span class="gal-cap">${ket(g)}</span>` : ''}
      </div>`).join('');
    grid.addEventListener('click', e => {
      const item = e.target.closest('.gal-item');
      if (item) openLb(Number(item.dataset.i));
    });
  }

  /* ============ BERANDA: MOSAIK 6 KOTAK, FOTO BERGANTI OTOMATIS ============ */
  const mosaic = document.getElementById('galMosaic');
  if (mosaic) {
    const JEDA = 2200;                       // jeda pergantian foto (milidetik)
    const N = Math.min(6, GALERI.length);    // tata letak dibuat untuk 6 kotak

    mosaic.innerHTML = Array.from({ length: N }, (_, i) => `
      <div class="gal-item gal-tile reveal" data-i="${i}">
        <img class="on" src="${GALERI[i].src}" alt="${GALERI[i].alt || ''}" />
        <img alt="" />
        <span class="gal-cap">${ket(GALERI[i])}</span>
      </div>`).join('');

    const tiles = Array.from(mosaic.querySelectorAll('.gal-tile'));

    // Klik kotak -> foto besar
    mosaic.addEventListener('click', e => {
      const t = e.target.closest('.gal-tile');
      if (t) openLb(Number(t.dataset.i));
    });

    // Ganti foto satu kotak dengan efek fade
    let terakhir = -1;
    function ganti() {
      if (document.hidden || GALERI.length <= N) return;

      // pilih kotak acak (bukan yang barusan berganti)
      let k;
      do { k = Math.floor(Math.random() * N); } while (k === terakhir && N > 1);
      terakhir = k;

      const tile = tiles[k];
      if (tile.matches(':hover')) return;   // jangan ganti kalau sedang disorot kursor

      // pilih foto yang belum tampil di kotak mana pun
      const tampil = new Set(tiles.map(t => Number(t.dataset.i)));
      const sisa = GALERI.map((_, i) => i).filter(i => !tampil.has(i));
      const baru = sisa[Math.floor(Math.random() * sisa.length)];

      const lama = tile.querySelector('img.on');
      const cadangan = tile.querySelector('img:not(.on)');
      const cap = tile.querySelector('.gal-cap');

      // muat dulu fotonya, baru di-fade supaya tidak berkedip
      const pra = new Image();
      pra.onload = () => {
        cadangan.src = GALERI[baru].src;
        cadangan.alt = GALERI[baru].alt || '';
        cadangan.classList.add('on');
        lama.classList.remove('on');
        cap.textContent = ket(GALERI[baru]);
        tile.dataset.i = baru;
      };
      pra.src = GALERI[baru].src;
    }

    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      setInterval(ganti, JEDA);
    }
  }
})();