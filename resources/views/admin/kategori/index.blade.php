@extends('layouts.admin')
@section('title', 'Manajemen Kategori')
@section('subtitle', 'Kelola kategori produk tahu')

@section('header-actions')
<a href="{{ route('admin.kategori.create') }}"
  class="bg-[#FF5C00] text-white font-bold text-sm px-6 py-3 rounded-xl shadow-lg shadow-orange-200/40 flex items-center gap-2 hover:scale-105 active:scale-95 transition-all">
  <span class="material-symbols-outlined text-sm">add</span> Tambah Kategori
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  @forelse($kategoris as $kat)
  <div class="bg-white rounded-2xl border border-orange-50 shadow-sm p-6 hover:shadow-lg transition-all group">
    <div class="flex justify-between items-start mb-4">
      <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
        <span class="material-symbols-outlined text-[#FF5C00]">category</span>
      </div>
      <div class="flex gap-2">
        <a href="{{ route('admin.kategori.edit', $kat) }}"
          class="p-2 bg-gray-100 hover:bg-orange-100 hover:text-[#FF5C00] rounded-lg transition-colors">
          <span class="material-symbols-outlined text-sm">edit</span>
        </a>
        <form action="{{ route('admin.kategori.destroy', $kat) }}" method="POST"
          onsubmit="return confirm('Yakin hapus kategori ini?')">
          @csrf @method('DELETE')
          <button class="p-2 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition-colors">
            <span class="material-symbols-outlined text-sm">delete</span>
          </button>
        </form>
      </div>
    </div>
    <h3 class="font-black text-on-surface mb-1">{{ $kat->nama }}</h3>
    <p class="text-xs text-gray-400 mb-3">{{ $kat->deskripsi ?? 'Tidak ada deskripsi' }}</p>
    <div class="flex items-center gap-2">
      <span class="bg-orange-100 text-[#FF5C00] text-xs font-bold px-3 py-1 rounded-full">
        {{ $kat->produks_count }} Produk
      </span>
    </div>
  </div>
  @empty
  <div class="md:col-span-3 text-center py-20">
    <span class="text-5xl block mb-4">🗂️</span>
    <p class="font-bold text-gray-400 mb-4">Belum ada kategori</p>
    <a href="{{ route('admin.kategori.create') }}"
      class="bg-[#FF5C00] text-white font-bold text-sm px-6 py-3 rounded-xl hover:scale-105 transition-all">
      + Tambah Kategori Pertama
    </a>
  </div>
  @endforelse
</div>
@endsection