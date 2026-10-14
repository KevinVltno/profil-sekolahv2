@extends('admin.layout')

@section('content')
<div class="card">
  <div class="card-header" style="display:flex;justify-content:space-between;align-items:center">
    <h2>Akun Guru ({{ $daftar->count() }})</h2>
    <button class="btn-primary" type="button" onclick="buka(null)">+ Tambah</button>
  </div>
  <div class="card-body">
    @if ($daftar->isEmpty())
      <p class="empty-state">Belum ada akun guru.</p>
    @else
    <div class="item-list">
      @foreach ($daftar as $g)
        <div class="item-row">
          <div class="item-info">
            <div class="item-name">{{ $g->nama }}</div>
            <div class="item-meta">Username: {{ $g->username }}</div>
          </div>
          <div class="item-actions">
            <button class="btn-edit" type="button" onclick='buka(@json($g))'>Edit</button>
            <form method="POST" action="{{ route('admin.guru.destroy', $g) }}" style="display:inline" onsubmit="return confirm('Hapus akun guru ini?')">
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
    <h3 id="mjudul">Tambah Akun Guru</h3>
    <form method="POST" id="form" action="{{ route('admin.guru.store') }}">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="method" disabled>

      <div class="form-group"><label>Nama Lengkap <i>*</i></label><input type="text" name="nama" id="f_nama" required></div>
      <div class="form-group"><label>Username <i>*</i></label><input type="text" name="username" id="f_username" required autocomplete="off"><small>Huruf, angka, strip, dan garis bawah, tanpa spasi.</small></div>
      <div class="form-group"><label>Password <i id="wajibPw">*</i></label><input type="password" name="password" id="f_password" minlength="8" autocomplete="new-password"><small id="infoPw">Minimal 8 karakter.</small></div>

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
const URL_STORE  = @json(route('admin.guru.store'));
const URL_UPDATE = @json(route('admin.guru.update', '__ID__'));
const modal = document.getElementById('modal');
const form  = document.getElementById('form');

function buka(r){
  form.action = r ? URL_UPDATE.replace('__ID__', r.id) : URL_STORE;
  document.getElementById('method').disabled = !r;
  document.getElementById('mjudul').textContent = r ? 'Edit Akun Guru' : 'Tambah Akun Guru';
  document.getElementById('f_nama').value = r ? r.nama : '';
  document.getElementById('f_username').value = r ? r.username : '';
  const pw = document.getElementById('f_password');
  pw.value = '';
  pw.required = !r;                                   // saat edit boleh dikosongkan
  document.getElementById('wajibPw').style.display = r ? 'none' : '';
  document.getElementById('infoPw').textContent = r ? 'Kosongkan jika tidak ingin mengganti password.' : 'Minimal 8 karakter.';
  modal.classList.add('open');
}
function tutup(){ modal.classList.remove('open'); }
modal.addEventListener('click', e => { if (e.target === modal) tutup(); });
</script>
@endpush