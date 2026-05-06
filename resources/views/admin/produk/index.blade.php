@extends('layouts.admin')
@section('title', 'Manajemen Produk')
@section('subtitle', 'Kelola semua menu tahu Anda di sini')
@section('content')

@section('header-actions')
<a href="{{ route('admin.produk.create') }}"
  class="bg-[#FF5C00] text-white font-bold text-sm px-6 py-3 rounded-xl shadow-lg shadow-orange-200/40 flex items-center gap-2 hover:scale-105 active:scale-95 transition-all">
  <span class="material-symbols-outlined text-sm">add</span> Tambah Produk
</a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-orange-50 overflow-hidden">

  {{-- Search --}}
  <div class="p-6 border-b border-gray-100 flex justify-between items-center">
    <p class="text-sm text-gray-500">Total <span class="font-black text-on-surface">{{ $produks->total() }}</span> produk</p>
    <div class="relative">
      <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
      <input type="text" placeholder="Cari produk..."
        class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm w-56 focus:ring-2 focus:ring-[#FF5C00] focus:outline-none"/>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead class="bg-gray-50 text-gray-400 font-bold text-xs uppercase tracking-widest border-b border-gray-100">
        <tr>
          <th class="px-6 py-4">Produk</th>
          <th class="px-6 py-4">Kategori</th>
          <th class="px-6 py-4">Harga</th>
          <th class="px-6 py-4">Stok</th>
          <th class="px-6 py-4">Status</th>
          <th class="px-6 py-4">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($produks as $produk)
        <tr class="hover:bg-orange-50/30 transition-colors">
          <td class="px-6 py-4">
            <div class="flex items-center gap-4">
              <div class="w-14 h-14 rounded-xl overflow-hidden bg-orange-50 flex-shrink-0 flex items-center justify-center">
                @if($produk->gambar)
                  <img src="{{ Storage::url($produk->gambar) }}" class="w-full h-full object-cover" alt="{{ $produk->nama }}">
                @else
                  <span class="text-2xl">🧀</span>
                @endif
              </div>
              <div>
                <p class="font-bold text-sm text-on-surface">{{ $produk->nama }}</p>
                <p class="text-xs text-gray-400">{{ Str::limit($produk->deskripsi, 40) }}</p>
              </div>
            </div>
          </td>
          <td class="px-6 py-4">
            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full">
              {{ $produk->kategori->nama }}
            </span>
          </td>
          <td class="px-6 py-4 font-bold text-sm">
            Rp{{ number_format($produk->harga, 0, ',', '.') }}
          </td>
          <td class="px-6 py-4">
            <span class="font-bold text-sm {{ $produk->stok <= 10 ? 'text-red-500' : 'text-on-surface' }}">
              {{ $produk->stok }} {{ $produk->satuan }}
            </span>
            @if($produk->stok <= 10)
              <p class="text-xs text-red-400">⚠ Stok menipis</p>
            @endif
          </td>
          <td class="px-6 py-4">
            @if($produk->aktif)
              <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
            @else
              <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Nonaktif</span>
            @endif
          </td>
          <td class="px-6 py-4">
            <div class="flex gap-2">
              <a href="{{ route('admin.produk.edit', $produk) }}"
                class="p-2 bg-gray-100 hover:bg-orange-100 hover:text-[#FF5C00] rounded-lg transition-colors" title="Edit">
                <span class="material-symbols-outlined text-sm">edit</span>
              </a>
              <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                @csrf @method('DELETE')
                <button class="p-2 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                  <span class="material-symbols-outlined text-sm">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-20 text-center">
            <span class="text-5xl block mb-4">📦</span>
            <p class="font-bold text-gray-400 mb-4">Belum ada produk</p>
            <a href="{{ route('admin.produk.create') }}"
              class="bg-[#FF5C00] text-white font-bold text-sm px-6 py-3 rounded-xl hover:scale-105 transition-all">
              + Tambah Produk Pertama
            </a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($produks->hasPages())
  <div class="p-6 border-t border-gray-100 flex justify-center">
    {{ $produks->links() }}
  </div>
  @endif
</div>
@endsection