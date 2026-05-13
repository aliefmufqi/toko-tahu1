@extends('layouts.admin')
@section('title', 'Edit Produk')
@section('subtitle', 'Ubah informasi produk yang sudah ada')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="bg-white rounded-xl shadow-sm border border-orange-50 overflow-hidden">
    <div class="p-8">
      <form action="{{ route('admin.produk.update', $produk) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div>
          <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
          <input type="text" id="nama" name="nama" value="{{ old('nama', $produk->nama) }}"
            class="w-full px-4 py-3 border @error('nama') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
            placeholder="Contoh: Tahu Balap Premium">
          @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Kategori -->
        <div>
          <label for="kategori_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
          <select id="kategori_id" name="kategori_id"
            class="w-full px-4 py-3 border @error('kategori_id') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
              <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama }}
              </option>
            @endforeach
          </select>
          @error('kategori_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
          <!-- Harga -->
          <div>
            <label for="harga" class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
            <input type="number" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" step="1000" min="0"
              class="w-full px-4 py-3 border @error('harga') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
              placeholder="0">
            @error('harga')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Stok -->
          <div>
            <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
            <input type="number" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" min="0"
              class="w-full px-4 py-3 border @error('stok') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
              placeholder="0">
            @error('stok')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Satuan -->
        <div>
          <label for="satuan" class="block text-sm font-bold text-gray-700 mb-2">Satuan</label>
          <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $produk->satuan) }}"
            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
            placeholder="Contoh: Pcs, Kg, Bungkus">
        </div>

        <!-- Deskripsi -->
        <div>
          <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
          <textarea id="deskripsi" name="deskripsi" rows="4"
            class="w-full px-4 py-3 border @error('deskripsi') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
            placeholder="Jelaskan keunggulan dan karakteristik produk...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
          @error('deskripsi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Gambar -->
        <div>
          <label for="gambar" class="block text-sm font-bold text-gray-700 mb-2">Gambar Produk</label>
          
          @if($produk->gambar)
            <div class="mb-4">
              <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
              <img src="{{ \App\Helpers\UploadHelper::url($produk->gambar) }}" alt="{{ $produk->nama }}" class="max-h-40 rounded-lg border border-gray-200">
            </div>
          @endif

          <div class="relative border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-[#FF5C00] transition cursor-pointer" onclick="document.getElementById('gambar').click()">
            <input type="file" id="gambar" name="gambar" accept="image/*" class="hidden"
              onchange="previewImage(event)">
            <div id="preview" class="hidden">
              <img id="previewImg" src="" alt="Preview" class="mx-auto max-h-48 mb-3">
              <p class="text-sm text-gray-600">Klik untuk mengubah gambar</p>
            </div>
            <div id="placeholder">
              <span class="text-4xl block mb-2">🖼️</span>
              <p class="font-bold text-gray-600">Klik atau drag gambar di sini</p>
              <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF max 2MB</p>
            </div>
          </div>
          @error('gambar')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Status Aktif -->
        <div class="flex items-center">
          <input type="checkbox" id="aktif" name="aktif" value="1" {{ old('aktif', $produk->aktif) ? 'checked' : '' }}
            class="w-4 h-4 text-[#FF5C00] border-gray-300 rounded focus:ring-2 focus:ring-[#FF5C00] cursor-pointer">
          <label for="aktif" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer">Produk Aktif</label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-100">
          <a href="{{ route('admin.produk.index') }}"
            class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition text-center">
            Batal
          </a>
          <button type="submit"
            class="flex-1 px-6 py-3 bg-[#FF5C00] text-white font-bold rounded-lg hover:scale-105 active:scale-95 transition">
            Perbarui Produk
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function previewImage(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('previewImg').src = e.target.result;
      document.getElementById('preview').classList.remove('hidden');
      document.getElementById('placeholder').classList.add('hidden');
    };
    reader.readAsDataURL(file);
  }
}
</script>
@endsection
