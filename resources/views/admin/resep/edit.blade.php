@extends('layouts.admin')
@section('title', 'Edit Resep')
@section('subtitle', 'Perbarui resep: ' . $resep->nama)

@section('header-actions')
<a href="{{ route('admin.resep.index') }}"
  style="display:flex; align-items:center; gap:8px; padding:10px 16px; border:2px solid #e5e7eb; color:#6b7280; font-weight:700; font-size:13px; border-radius:12px; text-decoration:none;">
  <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('admin.resep.update', $resep) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

    <div style="display:flex; flex-direction:column; gap:20px;">
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 20px;">Informasi Dasar</h3>
        <div style="display:flex; flex-direction:column; gap:16px;">

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Nama Resep *</label>
            <input type="text" name="nama" value="{{ old('nama', $resep->nama) }}" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Kategori *</label>
              <select name="kategori" required style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
                @foreach(['Street Style','Vegan Specials','Quick & Spicy'] as $kat)
                <option value="{{ $kat }}" {{ old('kategori', $resep->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Level *</label>
              <select name="level" required style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
                @foreach(['Beginner','Easy','Intermediate','Expert'] as $lvl)
                <option value="{{ $lvl }}" {{ old('level', $resep->level) == $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Waktu (Menit)</label>
              <input type="number" name="waktu" value="{{ old('waktu', $resep->waktu) }}" min="1"
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Harga (Rp)</label>
              <input type="number" name="harga" value="{{ old('harga', $resep->harga) }}" min="0"
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Emoji</label>
              <input type="text" name="emoji" value="{{ old('emoji', $resep->emoji) }}"
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:20px; font-family:inherit; box-sizing:border-box; outline:none; text-align:center;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Badge</label>
              <select name="badge" style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
                @foreach(['NEW','SPICY','FRESH','VEGAN',"CHEF'S CHOICE",'TRADITIONAL'] as $b)
                <option value="{{ $b }}" {{ old('badge', $resep->badge) == $b ? 'selected' : '' }}>{{ $b }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Warna Badge</label>
              <input type="color" name="badge_color" value="{{ old('badge_color', $resep->badge_color) }}"
                style="width:100%; height:42px; border:1px solid #e5e7eb; border-radius:10px; padding:4px; cursor:pointer; box-sizing:border-box;">
            </div>
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Deskripsi *</label>
            <textarea name="deskripsi" rows="3" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:none;"
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('deskripsi', $resep->deskripsi) }}</textarea>
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Tips Chef</label>
            <textarea name="tips" rows="2"
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:none;"
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('tips', $resep->tips) }}</textarea>
          </div>

          <div style="display:flex; align-items:center; gap:12px; padding:14px; background:#f9fafb; border-radius:12px;">
            <label style="position:relative; display:inline-flex; align-items:center; cursor:pointer;" onclick="toggleSwitch()">
              <input type="checkbox" name="aktif" value="1" id="toggle-aktif" {{ old('aktif', $resep->aktif) ? 'checked' : '' }} style="display:none;">
              <div id="toggle-bg" style="width:44px; height:24px; background:{{ old('aktif', $resep->aktif) ? '#FF5C00' : '#d1d5db' }}; border-radius:12px; position:relative; cursor:pointer; transition:background 0.2s;">
                <div style="position:absolute; top:3px; left:{{ old('aktif', $resep->aktif) ? '22px' : '3px' }}; width:18px; height:18px; background:white; border-radius:50%; transition:left 0.2s; box-shadow:0 1px 3px rgba(0,0,0,0.2);"></div>
              </div>
            </label>
            <div>
              <p style="font-size:13px; font-weight:700; color:#1f2937; margin:0;">Resep Aktif</p>
              <p style="font-size:11px; color:#9ca3af; margin:0;">Tampil di halaman publik</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:20px;">
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 16px;">Foto Resep</h3>
        @if($resep->gambar)
        <img src="{{ Storage::url($resep->gambar) }}" style="width:100%; border-radius:12px; max-height:160px; object-fit:cover; margin-bottom:12px;">
        @endif
        <div style="border:2px dashed #ffe4cc; border-radius:12px; padding:20px; text-align:center; cursor:pointer;" onclick="document.getElementById('gambar-input').click()">
          <span class="material-symbols-outlined" style="font-size:28px; color:#FF5C00; display:block; margin-bottom:6px;">cloud_upload</span>
          <p style="font-size:12px; color:#9ca3af; margin:0;">Klik untuk ganti foto</p>
          <input type="file" name="gambar" id="gambar-input" accept="image/*" style="display:none;" onchange="previewImg(this)">
        </div>
        <div id="preview-wrap" style="display:none; margin-top:12px;">
          <img id="preview-img" style="width:100%; border-radius:12px; max-height:160px; object-fit:cover;">
        </div>
      </div>

      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 8px;">Bahan-Bahan *</h3>
        <p style="font-size:11px; color:#9ca3af; margin:0 0 12px;">Satu bahan per baris</p>
        <textarea name="bahan" rows="8" required
          style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:vertical;"
          onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('bahan', implode("\n", $resep->bahan ?? [])) }}</textarea>
      </div>

      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 8px;">Cara Membuat *</h3>
        <p style="font-size:11px; color:#9ca3af; margin:0 0 12px;">Satu langkah per baris</p>
        <textarea name="langkah" rows="8" required
          style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:vertical;"
          onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('langkah', implode("\n", $resep->langkah ?? [])) }}</textarea>
      </div>

      <div style="display:flex; gap:12px;">
        <button type="submit"
          style="flex:1; background:#FF5C00; color:white; font-weight:800; font-size:14px; padding:14px; border-radius:12px; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px;"
          onmouseover="this.style.background='#e05000'" onmouseout="this.style.background='#FF5C00'">
          <span class="material-symbols-outlined" style="font-size:18px;">save</span> Simpan Perubahan
        </button>
        <a href="{{ route('admin.resep.index') }}"
          style="padding:14px 20px; border:2px solid #e5e7eb; color:#6b7280; font-weight:700; font-size:14px; border-radius:12px; text-decoration:none; display:flex; align-items:center;">
          Batal
        </a>
      </div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
<script>
function previewImg(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('preview-img').src = e.target.result;
      document.getElementById('preview-wrap').style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function toggleSwitch() {
  const cb = document.getElementById('toggle-aktif');
  const bg = document.getElementById('toggle-bg');
  const dot = bg.querySelector('div');
  cb.checked = !cb.checked;
  if (cb.checked) {
    bg.style.background = '#FF5C00';
    dot.style.left = '22px';
  } else {
    bg.style.background = '#d1d5db';
    dot.style.left = '3px';
  }
}
</script>
@endpush