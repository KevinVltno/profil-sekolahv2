@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header" style="display:flex;justify-content:space-between;align-items:center">
    <h2>Data ({{ $daftar->count() }})</h2>
    <button class="btn-primary" type="button" onclick="buka(null)">+ Tambah</button>
  </div>
  <div class="card-body">
    @if ($daftar->isEmpty())
      <p class="empty-state">Belum ada data.</p>
    @else
    <div class="item-list">
      @foreach ($daftar as $r)
        @php
          $meta = array_filter([
            $r->tanggal?->format('d-m-Y'),
            $r->bintang > 0 ? str_repeat('★', $r->bintang) : '',
            $r->tahun,
            $r->teks2,
            Str::limit((string) $r->teks, 110),
          ]);
        @endphp
        <div class="item-row">
          @if ($r->gambar)<img class="item-thumb" src="{{ asset($r->gambar) }}" alt="">@endif
          <div class="item-info">
            <div class="item-name">{{ ikon($r->ikon) }} {{ $r->judul !== '' ? $r->judul : Str::limit((string) $r->teks, 60) }}</div>
            <div class="item-meta">{{ implode(' · ', $meta) }}@if ($pakaiUrutan) · Urutan {{ $r->urutan }}@endif</div>
          </div>
          <div class="item-actions">
            <button class="btn-edit" type="button" onclick='buka(@json($r))'>Edit</button>
            <form method="POST" action="{{ route('admin.konten.destroy', [$s, $r]) }}" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
              @csrf @method('DELETE')
              <button class="btn-danger" type="submit">Hapus</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
    @endif
  </div>
</div>

<div class="modal-bg" id="modal">
  <div class="modal">
    <h3 id="mjudul">Tambah Data</h3>
    <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('admin.konten.store', $s) }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="method" disabled>

      @foreach ($fields as $f)
      <div class="form-group">
        <label>{{ $f['label'] }}@if ($f['wajib']) <i>*</i>@endif</label>
        @if ($f['tipe'] === 'image')
          <img class="preview-img" id="prev" alt="" style="display:none;max-height:90px;margin-bottom:8px">
          <input type="file" name="gambar" id="f_gambar" accept="image/jpeg,image/png,image/webp,image/gif" onchange="previewFile(this)">
          <small>JPG/PNG/WEBP/GIF, maks 3 MB. Saat edit, kosongkan jika tidak ingin mengganti foto.</small>
        @elseif ($f['tipe'] === 'area')
          <textarea name="{{ $f['k'] }}" id="f_{{ $f['k'] }}" rows="4" @required($f['wajib'])></textarea>
        @elseif ($f['tipe'] === 'star')
          <select name="{{ $f['k'] }}" id="f_{{ $f['k'] }}">
            @for ($i = 5; $i >= 1; $i--)<option value="{{ $i }}">{{ str_repeat('★', $i) }} ({{ $i }})</option>@endfor
          </select>
        @else
          <input type="{{ $f['tipe'] === 'date' ? 'date' : 'text' }}" name="{{ $f['k'] }}" id="f_{{ $f['k'] }}" @required($f['wajib'])>
        @endif
      </div>
      @endforeach

      @if ($pakaiUrutan)
      <div class="form-group"><label>Urutan</label><input type="number" name="urutan" id="f_urutan" value="0"></div>
      @endif

      <div class="modal-actions">
        <button class="btn-primary" type="submit">Simpan</button>
        <button class="btn-ghost" type="button" onclick="tutup()">Batal</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
const KOLOM      = @json(array_column($fields, 'k'));
const URL_STORE  = @json(route('admin.konten.store', $s));
const URL_UPDATE = @json(route('admin.konten.update', [$s, '__ID__']));
const ASSET_BASE = @json(url('/') . '/');
const modal = document.getElementById('modal');
const form  = document.getElementById('form');

function previewFile(i){
  const p = document.getElementById('prev');
  if (i.files && i.files[0]) {
    const r = new FileReader();
    r.onload = e => { p.src = e.target.result; p.style.display = 'block'; };
    r.readAsDataURL(i.files[0]);
  }
}
function buka(r){
  form.action = r ? URL_UPDATE.replace('__ID__', r.id) : URL_STORE;
  document.getElementById('method').disabled = !r;
  document.getElementById('mjudul').textContent = r ? 'Edit Data' : 'Tambah Data';
  KOLOM.forEach(k => {
    const el = document.getElementById('f_' + k);
    if (el && el.type !== 'file') el.value = r ? (r[k] ?? '') : (k === 'bintang' ? 5 : '');
  });
  const u = document.getElementById('f_urutan'); if (u) u.value = r ? r.urutan : 0;
  const p = document.getElementById('prev'), f = document.getElementById('f_gambar');
  if (f) {
    f.value = '';
    if (r && r.gambar) { p.src = ASSET_BASE + r.gambar; p.style.display = 'block'; } else p.style.display = 'none';
  }
  modal.classList.add('open');
}
function tutup(){ modal.classList.remove('open'); }
modal.addEventListener('click', e => { if (e.target === modal) tutup(); });
</script>
@endpush