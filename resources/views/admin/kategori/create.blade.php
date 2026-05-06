@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('subtitle', 'Tambahkan kategori produk tahu baru')

@section('content')
<div class="max-w-2xl mx-auto">
  <div class="bg-white rounded-xl shadow-sm border border-orange-50 overflow-hidden">
    <div class="p-8">
      <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nama Kategori -->
        <div>
          <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
          <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
            class="w-full px-4 py-3 border @error('nama') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
            placeholder="Contoh: Tahu Mentah, Tahu Goreng, Tahu Sutra">
          @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Deskripsi -->
        <div>
          <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi <span class="text-gray-400 text-xs">(Opsional)</span></label>
          <textarea id="deskripsi" name="deskripsi" rows="5"
            class="w-full px-4 py-3 border @error('deskripsi') border-red-500 @else border-gray-200 @enderror rounded-lg focus:ring-2 focus:ring-[#FF5C00] focus:outline-none transition"
            placeholder="Jelaskan jenis dan karakteristik produk dalam kategori ini...">{{ old('deskripsi') }}</textarea>
          @error('deskripsi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-100">
          <a href="{{ route('admin.kategori.index') }}"
            class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition text-center">
            Batal
          </a>
          <button type="submit"
            class="flex-1 px-6 py-3 bg-[#FF5C00] text-white font-bold rounded-lg hover:scale-105 active:scale-95 transition">
            Simpan Kategori
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection