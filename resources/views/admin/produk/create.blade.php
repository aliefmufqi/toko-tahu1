@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('subtitle', 'Tambahkan menu tahu baru ke toko Anda')

@section('header-actions')
<a href="{{ route('admin.produk.index') }}"
  style="display:flex; align-items:center; gap:8px; padding:10px 16px; border:2px solid #e5e7eb; color:#6b7280; font-weight:700; font-size:13px; border-radius:12px; text-decoration:none;">
  <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

    {{-- Kiri --}}
    <div style="display:flex; flex-direction:column; gap:20px;">
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 20px;">Informasi Produk</h3>
        <div style="display:flex; flex-direction:column; gap:16px;">

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Nama Produk *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
              placeholder="Contoh: Tahu Gejrot Super Pedas"
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
            @error('nama')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Kategori *</label>
            <select name="kategori_id" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
              <option value="">-- Pilih Kategori --</option>
              @foreach($kategoris as $kat)
              <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
              @endforeach
            </select>
            @error('kategori_id')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Deskripsi *</label>
            <textarea name="deskripsi" rows="4" required
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; resize:none;"
              placeholder="Deskripsikan produk tahu Anda..."
              onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Harga (Rp) *</label>
              <input type="number" name="harga" value="{{ old('harga') }}" min="0" required
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
                placeholder="12500"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
              @error('harga')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
            <div>
              <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Stok *</label>
              <input type="number" name="stok" value="{{ old('stok', 0) }}" min="0" required
                style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none;"
                onfocus="this.style.borderColor='#FF5C00'" onblur="this.style.borderColor='#e5e7eb'">
              @error('stok')<p style="color:#ef4444; font-size:11px; margin:4px 0 0;">{{ $message }}</p>@enderror
            </div>
          </div>

          <div>
            <label style="display:block; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Satuan</label>
            <select name="satuan"
              style="width:100%; border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px; font-size:13px; font-family:inherit; box-sizing:border-box; outline:none; background:white;">
              <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
              <option value="bungkus" {{ old('satuan') == 'bungkus' ? 'selected' : '' }}>Bungkus</option>
              <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
              <option value="porsi" {{ old('satuan') == 'porsi' ? 'selected' : '' }}>Porsi</option>
            </select>
          </div>

          <div style="display:flex; align-items:center; gap:12px; padding:14px; background:#f9fafb; border-radius:12px;">
            <label style="display:flex; align-items:center; cursor:pointer;" onclick="toggleSwitch()">
              <input type="checkbox" name="aktif" value="1" checked id="toggle-aktif" style="display:none;">
              <div id="toggle-bg" style="width:44px; height:24px; background:#FF5C00; border-radius:12px; position:relative; cursor:pointer;">
                <div style="position:absolute; top:3px; left:22px; width:18px; height:18px; background:white; border-radius:50%; box-shadow:0 1px 3px rgba(0,0,0,0.2);"></div>
              </div>
            </label>
            <div>
              <p style="font-size:13px; font-weight:700; color:#1f2937; margin:0;">Produk Aktif</p>
              <p style="font-size:11px; color:#9ca3af; margin:0;">Tampil di halaman publik</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Kanan --}}
    <div style="display:flex; flex-direction:column; gap:20px;">
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:24px;">
        <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 16px;">Foto Produk</h3>
        <div id="drop-zone"
          style="border:2px dashed #ffe4cc; border-radius:12px; padding:32px; text-align:center; cursor:pointer;"
          onclick="document.getElementById('gambar-input').click()">
          <span class="material-symbols-outlined" style="font-size:36px; color:#FF5C00; display:block; margin-bottom:8px;">cloud_upload</span>
          <p style="font-size:13px; font-weight:700; color:#1f2937; margin:0 0 4px;">Klik untuk upload gambar</p>
          <p style="font-size:11px; color:#9ca3af; margin:0;">PNG, JPG – Maks 2MB</p>
          <input type="file" name="gambar" id="gambar-input" accept="image/*" style="display:none;" onchange="previewImage(this)">
        </div>
        <div id="preview-container" style="display:none; margin-top:12px;">
          <img id="preview-img" style="width:100%; max-height:220px; object-fit:cover; border-radius:12px;">
          <button type="button" onclick="clearPreview()"
            style="margin-top:8px; background:none; border:none; color:#ef4444; font-size:12px; font-weight:700; cursor:pointer;">
            ✕ Hapus Gambar
          </button>
        </div>
      </div>

      <div style="display:flex; gap:12px;">
        <button type="submit"
          style="flex:1; background:#FF5C00; color:white; font-weight:800; font-size:14px; padding:14px; border-radius:12px; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px;"
          onmouseover="this.style.background='#e05000'" onmouseout="this.style.background='#FF5C00'">
          <span class="material-symbols-outlined" style="font-size:18px;">save</span> Simpan Produk
        </button>
        <a href="{{ route('admin.produk.index') }}"
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
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('preview-img').src = e.target.result;
      document.getElementById('preview-container').style.display = 'block';
      document.getElementById('drop-zone').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function clearPreview() {
  document.getElementById('gambar-input').value = '';
  document.getElementById('preview-container').style.display = 'none';
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