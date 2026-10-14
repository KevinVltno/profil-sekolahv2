@extends('admin.layout')

@section('content')
<div class="card" style="max-width:440px">
  <div class="card-header"><h2>Ganti Password</h2></div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.akun.update') }}">
      @csrf
      <div class="form-group"><label>Password Lama</label><input type="password" name="lama" required autocomplete="current-password"></div>
      <div class="form-group"><label>Password Baru</label><input type="password" name="baru" required minlength="8" autocomplete="new-password"></div>
      <div class="form-group"><label>Ulangi Password Baru</label><input type="password" name="baru_confirmation" required minlength="8" autocomplete="new-password"></div>
      <button type="submit" class="btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection