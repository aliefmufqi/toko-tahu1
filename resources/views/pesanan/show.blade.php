@extends('layouts.app')
@section('title', 'Detail Pesanan')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
  <div class="flex items-center gap-4 mb-8">
    <a href="{{ route('pesanan.index') }}"
      class="p-2 bg-surface-container rounded-full hover:bg-surface-container-high transition-colors">
      <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <div>
      <p class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-1">Nomor Pesanan</p>
      <h1 class="text-3xl font-black text-on-surface">#{{ $pesanan->kode_pesanan }}</h1>
      <p class="text-sm text-on-surface-variant mt-1">Dibuat {{ $pesanan->created_at->format('d M Y H:i') }}</p>
    </div>
  </div>

  @php
    $statusMap = [
      'menunggu'    => ['bg-orange-100', 'text-orange-700', 'Menunggu Pesanan', 'Silakan selesaikan pembayaran atau tunggu konfirmasi admin.'],
      'dikonfirmasi'=> ['bg-amber-100',  'text-amber-700',  'Pesanan Dikonfirmasi', 'Pembayaran diterima dan pesanan akan diproses.'],
      'diproses'    => ['bg-blue-100',   'text-blue-700',   'Sedang Diproses', 'Pesanan sedang disiapkan.'],
      'dikirim'     => ['bg-purple-100', 'text-purple-700', 'Dalam Pengiriman', 'Pesanan sedang dalam perjalanan.'],
      'selesai'     => ['bg-green-100',  'text-green-700',  'Pesanan Selesai', 'Terima kasih atas pesanan Anda!'],
      'dibatalkan'  => ['bg-red-100',    'text-red-700',    'Pesanan Dibatalkan', 'Pesanan ini telah dibatalkan.'],
    ];
    $status = $statusMap[$pesanan->status] ?? ['bg-gray-100', 'text-gray-700', ucfirst($pesanan->status), ''];
  @endphp

  {{-- Status Banner --}}
  <div class="rounded-3xl p-5 mb-8 bg-gradient-to-r from-orange-50 to-white border border-orange-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
      <p class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-2">Status Pesanan</p>
      <p class="text-xl font-black {{ $status[1] }}">{{ $status[2] }}</p>
      <p class="text-sm {{ $status[1] }} mt-1">{{ $status[3] }}</p>
    </div>
    <div class="rounded-2xl px-4 py-3 {{ $status[0] }} text-sm font-bold {{ $status[1] }}">
      {{ strtoupper($pesanan->status) }}
    </div>
  </div>

  <div class="grid gap-6 lg:grid-cols-[1.7fr_1fr]">
    <div class="space-y-6">

      {{-- Item Pesanan --}}
      <div class="bg-white rounded-3xl border border-orange-100 p-6">
        <h2 class="font-bold mb-4 flex items-center gap-2 text-lg">
          <span class="material-symbols-outlined text-[#FF5C00]">receipt_long</span> Item Pesanan
        </h2>
        <div class="space-y-3">
          @foreach($pesanan->detailPesanans as $detail)
          <div class="flex items-center gap-4 p-4 bg-orange-50 rounded-3xl">
            {{-- Gambar Produk --}}
            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-orange-100 flex items-center justify-center flex-shrink-0">
              @if($detail->produk && $detail->produk->gambar)
                <img src="{{ Storage::url($detail->produk->gambar) }}" class="w-full h-full object-cover" alt="{{ $detail->produk->nama ?? '' }}">
              @else
                <span class="text-2xl">🧀</span>
              @endif
            </div>
            {{-- Info Produk --}}
            <div class="flex-1">
              <p class="font-bold text-sm text-on-surface">
                {{ $detail->produk->nama ?? 'Produk telah dihapus' }}
              </p>
              <p class="text-xs text-on-surface-variant mt-1">
                {{ $detail->jumlah }} x Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}
              </p>
            </div>
            {{-- Subtotal --}}
            <p class="font-black text-sm text-[#FF5C00] flex-shrink-0">
              Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
            </p>
          </div>
          @endforeach
        </div>

        {{-- Kalkulasi --}}
        <div class="mt-6 rounded-3xl bg-surface-container p-4 border border-gray-200">
          <div class="flex justify-between text-sm text-on-surface-variant mb-2">
            <span>Subtotal</span>
            <span>Rp{{ number_format($pesanan->total_harga - $pesanan->ongkos_kirim, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between text-sm text-on-surface-variant mb-2">
            <span>Ongkos Kirim</span>
            <span>Rp{{ number_format($pesanan->ongkos_kirim, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between text-base font-black text-on-surface border-t border-gray-200 pt-2 mt-2">
            <span>Total</span>
            <span class="text-[#FF5C00]">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
          </div>
        </div>
      </div>

      {{-- Info Pengiriman --}}
      <div class="bg-white rounded-3xl border border-orange-100 p-6">
        <h2 class="font-bold mb-4 flex items-center gap-2 text-lg">
          <span class="material-symbols-outlined text-[#FF5C00]">location_on</span> Info Pengiriman
        </h2>
        <div class="space-y-4 text-sm">
          <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-1">Penerima</p>
            <p class="font-semibold">{{ $pesanan->user->name }}</p>
          </div>
          <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-1">Telepon</p>
            <p class="font-semibold">{{ $pesanan->telepon }}</p>
          </div>
          <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-1">Alamat</p>
            <p class="font-semibold leading-relaxed">{{ $pesanan->alamat_pengiriman }}</p>
          </div>
          @if($pesanan->catatan)
          <div>
            <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-1">Catatan</p>
            <p class="font-semibold">{{ $pesanan->catatan }}</p>
          </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Kolom Kanan: Pembayaran --}}
    <div class="space-y-6">
      <div class="bg-white rounded-3xl border border-orange-100 p-6">
        <h2 class="font-bold mb-4 flex items-center gap-2 text-lg">
          <span class="material-symbols-outlined text-[#FF5C00]">payments</span> Pembayaran
        </h2>

        @if($pesanan->pembayaran && $pesanan->pembayaran->metode_bayar === 'cod')
          {{-- COD --}}
          <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-4 mb-4">
            <p class="text-xs uppercase tracking-[0.2em] text-yellow-700 mb-2">Bayar di Tempat (COD)</p>
            <p class="font-black text-yellow-800 text-xl">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
            <p class="text-sm text-yellow-700 mt-2">Bayar tunai saat kurir tiba di alamat Anda.</p>
          </div>
          @if($pesanan->pembayaran->status === 'menunggu')
          <div class="rounded-2xl border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-800">
            <p class="font-bold">Menunggu Konfirmasi Admin</p>
            <p class="mt-1">Pesanan akan diproses setelah admin memeriksa.</p>
          </div>
          @else
          <div class="rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            <p class="font-bold">Pembayaran Dikonfirmasi ✓</p>
            <p class="mt-1">Dikonfirmasi pada {{ $pesanan->pembayaran->updated_at->format('d M Y H:i') }}</p>
          </div>
          @endif

        @elseif(!$pesanan->pembayaran || $pesanan->pembayaran->status === 'ditolak')
          {{-- Belum Bayar / Ditolak --}}
          <div class="rounded-2xl border border-orange-200 bg-orange-50 p-4 mb-4">
            <p class="text-xs uppercase tracking-[0.2em] text-orange-700 mb-2">Transfer ke Rekening</p>
            <p class="font-black">BCA · 1234567890</p>
            <p class="text-sm text-gray-500">a.n. TahuBalap Indonesia</p>
            <p class="font-black text-[#FF5C00] mt-3 text-xl">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
          </div>
          <form action="{{ route('pesanan.bayar', $pesanan->kode_pesanan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
              <label class="block text-xs uppercase tracking-[0.2em] text-gray-400 mb-2">Upload Bukti Transfer</label>
              <input type="file" name="bukti_transfer" accept="image/*" required
                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-bold file:bg-orange-100 file:text-[#FF5C00] hover:file:bg-orange-200">
            </div>
            <button type="submit"
              class="w-full bg-[#FF5C00] text-white font-bold py-3 rounded-xl hover:bg-[#e05000] active:scale-95 transition-all text-sm">
              Kirim Bukti Pembayaran
            </button>
          </form>

        @elseif($pesanan->pembayaran->status === 'menunggu')
          {{-- Menunggu Konfirmasi --}}
          <div class="text-center py-6">
            <span class="material-symbols-outlined text-4xl text-yellow-500 mb-3 block" style="font-variation-settings: 'FILL' 1">pending</span>
            <p class="font-bold mb-1">Bukti Transfer Dikirim!</p>
            <p class="text-xs text-gray-500 mb-4">Menunggu konfirmasi admin. Biasanya 1-2 jam.</p>
            <img src="{{ Storage::url($pesanan->pembayaran->bukti_transfer) }}"
              class="mx-auto w-36 h-36 object-cover rounded-2xl border">
          </div>

        @elseif($pesanan->pembayaran->status === 'dikonfirmasi')
          {{-- Sudah Dikonfirmasi --}}
          <div class="text-center py-6">
            <span class="material-symbols-outlined text-4xl text-green-500 mb-3 block" style="font-variation-settings: 'FILL' 1">check_circle</span>
            <p class="font-bold mb-1">Pembayaran Dikonfirmasi! ✓</p>
            <p class="text-xs text-gray-500">Dikonfirmasi pada {{ $pesanan->pembayaran->updated_at->format('d M Y H:i') }}</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection