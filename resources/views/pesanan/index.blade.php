@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
  <header class="mb-10">
    <h1 class="text-display-lg font-black text-on-surface mb-2">Pesanan Saya</h1>
    <p class="text-body-md text-on-surface-variant">Pantau status pesanan tahu kamu di sini.</p>
  </header>

  @if($pesanans->count() > 0)
  <div class="space-y-4">
    @foreach($pesanans as $pesanan)
    @php
      $sc = [
        'menunggu'    => ['bg-error-container', 'text-on-error-container', 'Menunggu Pembayaran'],
        'dikonfirmasi'=> ['bg-secondary-fixed', 'text-on-secondary-fixed-variant', 'Dikonfirmasi'],
        'diproses'    => ['bg-primary-fixed', 'text-primary', 'Sedang Diproses'],
        'dikirim'     => ['bg-surface-container-high', 'text-on-surface-variant', 'Dalam Pengiriman'],
        'selesai'     => ['bg-tertiary-fixed', 'text-on-tertiary-fixed-variant', 'Selesai'],
        'dibatalkan'  => ['bg-error-container', 'text-on-error-container', 'Dibatalkan'],
      ][$pesanan->status] ?? ['bg-surface-container', 'text-on-surface-variant', ucfirst($pesanan->status)];
    @endphp
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant p-6 hover:shadow-lg transition-all group">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <div class="flex items-center gap-3 mb-2">
            <span class="font-black text-on-surface">#{{ $pesanan->kode_pesanan }}</span>
            <span class="{{ $sc[0] }} {{ $sc[1] }} text-xs font-bold px-3 py-1 rounded-full">{{ $sc[2] }}</span>
          </div>
          <p class="text-xs text-on-surface-variant">{{ $pesanan->created_at->format('d M Y, H:i') }} · {{ $pesanan->detailPesanans->count() }} item</p>
        </div>
        <div class="flex items-center gap-4">
          <p class="font-black text-primary-container">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
          <a href="{{ route('pesanan.show', $pesanan->kode_pesanan) }}" class="flex items-center gap-1 text-primary font-bold text-sm hover:underline">
            Detail <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  @else
  <div class="text-center py-24">
    <span class="text-8xl block mb-6">📦</span>
    <h3 class="font-bold text-on-surface mb-2">Belum ada pesanan</h3>
    <p class="text-on-surface-variant text-sm mb-8">Yuk mulai pesan tahu favoritmu!</p>
    <a href="{{ route('produk.index') }}" class="bg-primary-container text-white font-bold px-8 py-4 rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-orange-200">
      Lihat Menu
    </a>
  </div>
  @endif
</div>
@endsection