@extends('admin.layout')

@section('content')
<div class="card"><div class="card-body">
  <form method="POST" action="{{ route('admin.pengaturan.update', $s) }}" enctype="multipart/form-data">
    @csrf
    @foreach ($fields as $f)
      @php $v = $nilai[$f['k']] ?? ''; @endphp
      <div class="form-group">
        <label>{{ $f['label'] }}</label>

        @if ($f['tipe'] === 'image')
          @if ($v)<div class="current-img"><img src="{{ asset($v) }}" alt="" style="max-height:80px"></div>@endif
          <input type="file" name="{{ $f['k'] }}" accept="image/jpeg,image/png,image/webp,image/gif">
          <small>JPG/PNG/WEBP/GIF, maks 3 MB. Kosongkan jika tidak ingin mengganti.</small>

        @elseif (in_array($f['tipe'], ['area', 'maps']))
          <textarea name="{{ $f['k'] }}" rows="3">{{ old($f['k'], $v) }}</textarea>
          @if ($f['tipe'] === 'maps')<small>Google Maps → Bagikan → Sematkan peta → tempel kode iframe atau URL src-nya.</small>@endif

        @else
          <input type="{{ in_array($f['tipe'], ['email', 'url']) ? $f['tipe'] : 'text' }}" name="{{ $f['k'] }}" value="{{ old($f['k'], $v) }}">
        @endif
      </div>
    @endforeach
    <button class="btn-primary" type="submit">Simpan</button>
  </form>
</div></div>
@endsection