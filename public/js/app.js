(function () {
  /* MENU MOBILE */
  const burger = document.getElementById('hamburger');
  const mobile = document.getElementById('mobile');
  burger.addEventListener('click', () => {
    burger.classList.toggle('open');
    mobile.classList.toggle('open');
  });
  document.getElementById('mDd').addEventListener('click', () => {
    document.getElementById('mSub').classList.toggle('open');
  });

  /* DROPDOWN DESKTOP (klik untuk layar sentuh) */
  const dd = document.querySelector('.has-dd');
  dd.querySelector('button').addEventListener('click', e => {
    e.stopPropagation();
    dd.classList.toggle('open');
  });
  document.addEventListener('click', () => dd.classList.remove('open'));

  /* ANIMASI MUNCUL SAAT SCROLL */
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('show'); io.unobserve(e.target); }
    });
  }, { threshold: .12 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  /* FORM KONTAK -> WHATSAPP (hanya ada di halaman kontak) */
  const WA_NUM = (document.body.dataset.wa || '').replace(/\D/g, '');
  const form = document.getElementById('waForm');
  if (form) {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const text = `Halo SD Santo Fransiskus,\nNama: ${form.nama.value.trim()}\nNo. HP: ${form.hp.value.trim()}\n\n${form.pesan.value.trim()}`;
      window.open('https://wa.me/' + WA_NUM + '?text=' + encodeURIComponent(text), '_blank');
    });
  }

  /* PANEL "LIHAT DETAIL" (halaman Fasilitas & Program) */
  document.querySelectorAll('.fas-media').forEach(box => {
    box.querySelector('.fas-btn').addEventListener('click', () => box.classList.add('open'));
    box.querySelector('.fas-close').addEventListener('click', () => box.classList.remove('open'));
  });
})();