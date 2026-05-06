@extends('layouts.admin')
@section('title', 'Tambah Resep')
@section('subtitle', 'Tambahkan resep tahu baru')

@section('header-actions')
<a href="{{ route('admin.resep.index') }}"
  style="display:flex; align-items:center; gap:8px; padding:10px 16px; border:2px solid #e5e7eb; color:#6b7280; font-weight:700; font-size:13px; border-radius:12px; text-decoration:none;">
  <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('admin.resep.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

    {{-- Kiri --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

      {{-- Info Dasar --}}
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 20px; display:flex; align-items:center; gap:8px;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">info</span> Informasi Dasar
        </h3>
        <div style="display:flex; flex-direction:column; gap:16px;">
          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Nama Resep *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
              placeholder="Contoh: Tahu Gejrot Super Pedas"
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            @error('nama')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Kategori *</label>
              <select name="kategori" required
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
                <option value="">-- Pilih --</option>
                <option value="Street Style" {{ old('kategori') == 'Street Style' ? 'selected' : '' }}>Street Style</option>
                <option value="Vegan Specials" {{ old('kategori') == 'Vegan Specials' ? 'selected' : '' }}>Vegan Specials</option>
                <option value="Quick & Spicy" {{ old('kategori') == 'Quick & Spicy' ? 'selected' : '' }}>Quick & Spicy</option>
              </select>
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Level *</label>
              <select name="level" required
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
                <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="Easy" {{ old('level') == 'Easy' ? 'selected' : '' }}>Easy</option>
                <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="Expert" {{ old('level') == 'Expert' ? 'selected' : '' }}>Expert</option>
              </select>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Waktu (Menit) *</label>
              <input type="number" name="waktu" value="{{ old('waktu', 15) }}" min="1" required
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Harga (Rp)</label>
              <input type="number" name="harga" value="{{ old('harga', 0) }}" min="0"
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Emoji</label>
              <input type="text" name="emoji" value="{{ old('emoji', '🧀') }}"
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:20px; font-family:inherit; box-sizing:border-box; outline:none; text-align:center;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Badge Label</label>
              <select name="badge"
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
                <option value="NEW">NEW</option>
                <option value="SPICY">SPICY</option>
                <option value="FRESH">FRESH</option>
                <option value="VEGAN">VEGAN</option>
                <option value="CHEF'S CHOICE">CHEF'S CHOICE</option>
                <option value="TRADITIONAL">TRADITIONAL</option>
              </select>
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Warna Badge</label>
              <input type="color" name="badge_color" value="{{ old('badge_color', '#FF5C00') }}"
                style="width:100%; height:42px; border:1px solid #e5e7eb; border-radius:10px; padding:4px; cursor:pointer; box-sizing:border-box;">
            </div>
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Deskripsi *</label>
            <textarea name="deskripsi" rows="3" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:none;"
              placeholder="Deskripsi singkat resep..."
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('deskripsi') }}</textarea>
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Tips Chef (Opsional)</label>
            <textarea name="tips" rows="2"
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:none;"
              placeholder="Tips rahasia chef..."
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('tips') }}</textarea>
          </div>

          {{-- Aktif toggle --}}
          <div style="display:flex; align-items:center; gap:12px; padding:14px; background:#f9fafb; border-radius:12px;">
            <label style="position:relative; display:inline-flex; align-items:center; cursor:pointer;">
              <input type="checkbox" name="aktif" value="1" checked style="display:none;" id="toggle-aktif">
              <div id="toggle-bg" onclick="toggleSwitch()" style="width:44px; height:24px; background:#FF5C00; border-radius:12px; position:relative; cursor:pointer; transition:background 0.2s;">
                <div style="position:absolute; top:3px; left:22px; width:18px; height:18px; background:white; border-radius:50%; transition:left 0.2s; box-shadow:0 1px 3px rgba(0,0,0,0.2);"></div>
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

    {{-- Kanan --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

      {{-- Upload Gambar --}}
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 16px; display:flex; align-items:center; gap:8px;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">image</span> Foto Resep
        </h3>
        <div style="border:2px dashed #ffe4cc; border-radius:12px; padding:32px; text-align:center; cursor:pointer;"
             onclick="document.getElementById('gambar-input').click()"
             id="drop-zone">
          <span class="material-symbols-outlined" style="font-size:36px; color:#FF5C00; display:block; margin-bottom:8px;">cloud_upload</span>
          <p style="font-size:13px; font-weight:700; color:#1f2937; margin:0 0 4px;">Klik untuk upload foto</p>
          <p style="font-size:11px; color:#9ca3af; margin:0;">PNG, JPG – Maks 2MB</p>
          <input type="file" name="gambar" id="gambar-input" accept="image/*" style="display:none;" onchange="previewImg(this)">
        </div>
        <div id="preview-wrap" style="display:none; margin-top:12px;">
          <img id="preview-img" style="width:100%; border-radius:12px; max-height:200px; object-fit:cover;">
          <button type="button" onclick="clearImg()" style="margin-top:8px; background:none; border:none; color:#ef4444; font-size:12px; font-weight:700; cursor:pointer;">✕ Hapus Foto</button>
        </div>
      </div>

      {{-- Bahan --}}
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 8px; display:flex; align-items:center; gap:8px;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">format_list_bulleted</span> Bahan-Bahan *
        </h3>
        <p style="font-size:11px; color:#9ca3af; margin:0 0 12px;">Tulis satu bahan per baris</p>
        <textarea name="bahan" rows="8" required
          style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:vertical;"
          placeholder="4 buah tahu putih&#10;3 siung bawang putih&#10;5 cabai rawit&#10;2 sdm kecap manis"
          onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('bahan') }}</textarea>
        @error('bahan')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
      </div>

      {{-- Langkah --}}
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 8px; display:flex; align-items:center; gap:8px;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">restaurant</span> Cara Membuat *
        </h3>
        <p style="font-size:11px; color:#9ca3af; margin:0 0 12px;">Tulis satu langkah per baris</p>
        <textarea name="langkah" rows="8" required
          style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:vertical;"
          placeholder="Potong tahu menjadi dadu, goreng hingga keemasan&#10;Haluskan bumbu bawang putih dan cabai&#10;Tumis bumbu halus hingga harum"
          onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('langkah') }}</textarea>
        @error('langkah')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
      </div>

      {{-- Submit --}}
      <div style="display:flex; gap:12px;">
        <button type="submit"
          style="flex:1; background:#FF5C00; color:white; font-weight:800; font-size:14px; padding:14px; border-radius:12px; border:none; cursor:pointer; box-shadow:0 4px 12px rgba(255,92,0,0.3); display:flex; align-items:center; justify-content:center; gap:8px;"
          onmouseover="this.style.background='#e05000'" onmouseout="this.style.background='#FF5C00'">
          <span class="material-symbols-outlined" style="font-size:18px;">save</span> Simpan Resep
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
      document.getElementById('drop-zone').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function clearImg() {
  document.getElementById('gambar-input').value = '';
  document.getElementById('preview-wrap').style.display = 'none';
  document.getElementById('drop-zone').style.display = 'block';
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