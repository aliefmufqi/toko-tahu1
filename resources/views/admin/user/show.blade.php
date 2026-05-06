@extends('layouts.admin')
@section('title', 'Detail Pengguna')
@section('subtitle', $user->name)

@section('header-actions')
<a href="{{ route('admin.user.index') }}"
  class="flex items-center gap-2 px-4 py-2 border-2 border-gray-200 text-gray-500 font-bold text-sm rounded-xl hover:bg-gray-50 transition-colors">
  <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

  {{-- Info Pengguna --}}
  <div class="bg-white rounded-2xl border border-orange-50 shadow-sm p-8 text-center">
    <div class="w-24 h-24 rounded-full mx-auto mb-4 flex items-center justify-center font-black text-3xl
      {{ $user->role === 'admin' ? 'bg-[#FF5C00] text-white' : 'bg-orange-100 text-[#FF5C00]' }}">
      {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
    <h3 class="font-black text-xl text-on-surface mb-1">{{ $user->name }}</h3>
    <p class="text-gray-400 text-sm mb-3">{{ $user->email }}</p>
    @if($user->role === 'admin')
      <span class="bg-[#FF5C00] text-white text-xs font-bold px-4 py-1.5 rounded-full">Admin</span>
    @else
      <span class="bg-orange-100 text-[#FF5C00] text-xs font-bold px-4 py-1.5 rounded-full">Customer</span>
    @endif

    <div class="mt-6 pt-6 border-t border-gray-100 space-y-3 text-left">
      <div>
        <p class="text-xs text-gray-400 font-bold uppercase">Telepon</p>
        <p class="font-semibold text-sm">{{ $user->telepon ?? '-' }}</p>
      </div>
      <div>
        <p class="text-xs text-gray-400 font-bold uppercase">Alamat</p>
        <p class="font-semibold text-sm">{{ $user->alamat ?? '-' }}</p>
      </div>
      <div>
        <p class="text-xs text-gray-400 font-bold uppercase">Bergabung</p>
        <p class="font-semibold text-sm">{{ $user->created_at->format('d M Y') }}</p>
      </div>
    </div>

    <a href="{{ route('admin.user.edit', $user) }}"
      class="mt-6 w-full bg-[#FF5C00] text-white font-bold py-3 rounded-xl hover:scale-105 transition-all flex items-center justify-center gap-2 text-sm">
      <span class="material-symbols-outlined text-sm">edit</span> Edit Pengguna
    </a>
  </div>

  {{-- Riwayat Pesanan --}}
  <div class="lg:col-span-2 bg-white rounded-2xl border border-orange-50 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100">
      <h3 class="font-bold text-on-surface">Riwayat Pesanan ({{ $pesanans->count() }})</h3>
    </div>
    <div class="divide-y divide-gray-50">
      @forelse($pesanans as $pesanan)
      @php
        $sc = [
          'menunggu'    => ['bg-orange-100', 'text-orange-700'],
          'dikonfirmasi'=> ['bg-yellow-100', 'text-yellow-700'],
          'diproses'    => ['bg-blue-100',   'text-blue-700'],
          'dikirim'     => ['bg-purple-100', 'text-purple-700'],
          'selesai'     => ['bg-green-100',  'text-green-700'],
          'dibatalkan'  => ['bg-red-100',    'text-red-700'],
        ][$pesanan->status] ?? ['bg-gray-100', 'text-gray-700'];
      @endphp
      <div class="p-5 flex items-center justify-between hover:bg-orange-50/30 transition-colors">
        <div>
          <p class="font-black text-sm">#{{ $pesanan->kode_pesanan }}</p>
          <p class="text-xs text-gray-400">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="flex items-center gap-4">
          <span class="{{ $sc[0] }} {{ $sc[1] }} text-xs font-bold px-3 py-1 rounded-full">
            {{ ucfirst($pesanan->status) }}
          </span>
          <p class="font-black text-sm text-[#FF5C00]">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
          <a href="{{ route('admin.pesanan.show', $pesanan->id) }}"
            class="text-[#FF5C00] hover:underline font-bold text-xs">Detail</a>
        </div>
      </div>
      @empty
      <div class="p-12 text-center">
        <span class="text-4xl block mb-3">📦</span>
        <p class="font-bold text-gray-400">Belum ada pesanan</p>
      </div>
      @endforelse
    </div>
  </div>
</div>
@endsection