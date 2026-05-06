@extends('layouts.admin')
@section('title', 'Manajemen Pesanan')
@section('subtitle', 'Pantau dan kelola semua pesanan masuk')

@section('content')

{{-- Filter Tabs --}}
<div class="flex gap-2 mb-6 overflow-x-auto pb-2">
  @php
    $statuses = [
      ''            => 'Semua',
      'menunggu'    => 'Menunggu',
      'dikonfirmasi'=> 'Dikonfirmasi',
      'diproses'    => 'Diproses',
      'dikirim'     => 'Dikirim',
      'selesai'     => 'Selesai',
      'dibatalkan'  => 'Dibatalkan',
    ];
    $current = request('status', '');
  @endphp
  @foreach($statuses as $val => $label)
  <a href="{{ route('admin.pesanan.index', $val !== '' ? ['status' => $val] : []) }}"
    class="flex-none px-5 py-2 rounded-full font-bold text-sm transition-all whitespace-nowrap
    {{ $current === $val ? 'bg-[#FF5C00] text-white shadow-lg shadow-orange-200' : 'bg-gray-100 text-gray-500 hover:bg-orange-100 hover:text-[#FF5C00]' }}">
    {{ $label }}
  </a>
  @endforeach
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl shadow-sm border border-orange-50 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead class="bg-gray-50 text-gray-400 font-bold text-xs uppercase tracking-widest border-b border-gray-100">
        <tr>
          <th class="px-6 py-4">Kode Pesanan</th>
          <th class="px-6 py-4">Customer</th>
          <th class="px-6 py-4">Tanggal</th>
          <th class="px-6 py-4">Total</th>
          <th class="px-6 py-4">Metode</th>
          <th class="px-6 py-4">Pembayaran</th>
          <th class="px-6 py-4">Status</th>
          <th class="px-6 py-4">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($pesanans as $pesanan)
        @php
          $statusColor = [
            'menunggu'    => ['bg-orange-100', 'text-orange-700'],
            'dikonfirmasi'=> ['bg-yellow-100', 'text-yellow-700'],
            'diproses'    => ['bg-blue-100',   'text-blue-700'],
            'dikirim'     => ['bg-purple-100', 'text-purple-700'],
            'selesai'     => ['bg-green-100',  'text-green-700'],
            'dibatalkan'  => ['bg-red-100',    'text-red-700'],
          ][$pesanan->status] ?? ['bg-gray-100', 'text-gray-700'];
        @endphp
        <tr class="hover:bg-orange-50/30 transition-colors">
          <td class="px-6 py-4 font-black text-sm">#{{ $pesanan->kode_pesanan }}</td>
          <td class="px-6 py-4">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-[#FF5C00] font-black text-xs">
                {{ strtoupper(substr($pesanan->user->name, 0, 1)) }}
              </div>
              <div>
                <p class="text-sm font-semibold">{{ $pesanan->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $pesanan->telepon }}</p>
              </div>
            </div>
          </td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }}</td>
          <td class="px-6 py-4 font-bold text-sm">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
          <td class="px-6 py-4">
            @if($pesanan->pembayaran)
              @if($pesanan->pembayaran->metode_bayar === 'cod')
                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded-full">COD</span>
              @else
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded-full">Transfer</span>
              @endif
            @else
              <span class="bg-gray-100 text-gray-500 text-xs font-bold px-2 py-1 rounded-full">-</span>
            @endif
          </td>
          <td class="px-6 py-4">
            @if($pesanan->pembayaran)
              @if($pesanan->pembayaran->status === 'dikonfirmasi')
                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">Lunas ✓</span>
              @elseif($pesanan->pembayaran->status === 'menunggu')
                <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded-full">Menunggu</span>
              @else
                <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full">Ditolak</span>
              @endif
            @else
              <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full">Belum Bayar</span>
            @endif
          </td>
          <td class="px-6 py-4">
            <span class="{{ $statusColor[0] }} {{ $statusColor[1] }} text-xs font-bold px-3 py-1 rounded-full">
              {{ ucfirst($pesanan->status) }}
            </span>
          </td>
          <td class="px-6 py-4">
            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}"
              class="flex items-center gap-1 text-[#FF5C00] hover:underline font-bold text-sm">
              <span class="material-symbols-outlined text-xs">visibility</span> Detail
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="px-6 py-20 text-center">
            <span class="text-5xl block mb-4">📭</span>
            <p class="font-bold text-gray-400">Tidak ada pesanan ditemukan</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($pesanans->hasPages())
  <div class="p-6 border-t border-gray-50 flex justify-center">
    {{ $pesanans->links() }}
  </div>
  @endif
</div>
@endsection