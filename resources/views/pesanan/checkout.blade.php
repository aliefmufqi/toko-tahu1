@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
  <header class="mb-10">
    <h1 class="text-display-lg font-black text-on-surface mb-2">Checkout</h1>
    <p class="text-body-md text-on-surface-variant">Lengkapi data pengiriman untuk menyelesaikan pesanan.</p>
  </header>

  <form action="{{ route('pesanan.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

      {{-- Form Pengiriman --}}
      <div class="lg:col-span-7 space-y-6">
        <div class="bg-white rounded-xl shadow-lg shadow-orange-100/50 border border-orange-50 p-8">
          <h3 class="font-bold text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-sm">location_on</span> Alamat Pengiriman
          </h3>

          <div class="space-y-4">
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Nama Penerima</label>
              <input type="text" value="{{ auth()->user()->name }}" disabled
                class="w-full border border-outline-variant rounded-xl px-4 py-3 text-sm bg-surface-container opacity-75">
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Nomor Telepon *</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">phone</span>
                <input type="text" name="telepon" value="{{ old('telepon', auth()->user()->telepon) }}"
                  class="w-full pl-11 pr-4 border border-outline-variant rounded-xl py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all @error('telepon') border-error @enderror"
                  placeholder="08xx-xxxx-xxxx">
              </div>
              @error('telepon')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Alamat Lengkap *</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-4 text-on-surface-variant text-sm">location_on</span>
                <textarea name="alamat_pengiriman" rows="3"
                  class="w-full pl-11 pr-4 border border-outline-variant rounded-xl py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low resize-none transition-all @error('alamat_pengiriman') border-error @enderror"
                  placeholder="Jl. Raya No. 123, RT/RW, Kelurahan, Kecamatan, Kota">{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>
              </div>
              @error('alamat_pengiriman')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Catatan (Opsional)</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-4 text-on-surface-variant text-sm">note</span>
                <textarea name="catatan" rows="2"
                  class="w-full pl-11 pr-4 border border-outline-variant rounded-xl py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] bg-surface-container-low resize-none transition-all"
                  placeholder="Contoh: Jangan terlalu pedas, taruh di depan pagar...">{{ old('catatan') }}</textarea>
              </div>
            </div>
          </div>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="bg-white rounded-xl shadow-lg shadow-orange-100/50 border border-orange-50 p-8">
          <h3 class="font-bold text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-sm">payments</span> Metode Pembayaran
          </h3>
          <div class="space-y-3">
            <label class="flex items-center gap-4 p-4 border-2 border-[#FF5C00] bg-primary-fixed/30 rounded-xl cursor-pointer">
              <input type="radio" name="metode_bayar" value="transfer" checked class="text-[#FF5C00]">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-fixed rounded-lg flex items-center justify-center">
                  <span class="material-symbols-outlined text-primary text-sm">account_balance</span>
                </div>
                <div>
                  <p class="font-bold text-sm text-on-surface">Transfer Bank</p>
                  <p class="text-xs text-on-surface-variant">BCA · 1234567890 a.n. TahuBalap</p>
                </div>
              </div>
            </label>
            <label class="flex items-center gap-4 p-4 border border-outline-variant rounded-xl cursor-pointer hover:border-[#FF5C00] hover:bg-primary-fixed/10 transition-all">
              <input type="radio" name="metode_bayar" value="cod" class="text-[#FF5C00]">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-secondary-fixed rounded-lg flex items-center justify-center">
                  <span class="material-symbols-outlined text-secondary text-sm">payments</span>
                </div>
                <div>
                  <p class="font-bold text-sm text-on-surface">Bayar di Tempat (COD)</p>
                  <p class="text-xs text-on-surface-variant">Bayar tunai saat pesanan tiba</p>
                </div>
              </div>
            </label>
          </div>
        </div>
      </div>

      {{-- Ringkasan Pesanan --}}
      <div class="lg:col-span-5">
        <div class="bg-white rounded-xl shadow-xl shadow-orange-900/5 border border-surface-variant p-8 sticky top-24">
          <h3 class="font-bold text-on-surface mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-sm">receipt_long</span> Detail Pesanan
          </h3>

          <div class="space-y-3 mb-6 max-h-60 overflow-y-auto pr-1">
            @foreach($keranjang as $id => $item)
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-xl flex-shrink-0 bg-primary-fixed flex items-center justify-center overflow-hidden">
                @if($item['gambar'])
                  <img src="{{ \App\Helpers\UploadHelper::url($item['gambar']) }}" class="w-full h-full object-cover">
                @else
                  <span class="text-xl">🧀</span>
                @endif
              </div>
              <div class="flex-grow min-w-0">
                <p class="text-sm font-semibold text-on-surface truncate">{{ $item['nama'] }}</p>
                <p class="text-xs text-on-surface-variant">{{ $item['jumlah'] }} x Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
              </div>
              <p class="text-sm font-black text-on-surface flex-shrink-0">Rp{{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</p>
            </div>
            @endforeach
          </div>

          <div class="border-t border-outline-variant pt-4 space-y-2 mb-6">
            <div class="flex justify-between text-sm text-on-surface-variant">
              <span>Subtotal ({{ count($keranjang) }} item)</span>
              <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm text-on-surface-variant">
              <span>Ongkos Kirim</span>
              <span class="text-tertiary font-bold">Rp5.000</span>
            </div>
            <div class="h-px bg-outline-variant my-2"></div>
            <div class="flex justify-between font-black text-on-surface">
              <span>Total Bayar</span>
              <span class="text-[#FF5C00] text-xl">Rp{{ number_format($total + 5000, 0, ',', '.') }}</span>
            </div>
          </div>

          <button type="submit" class="w-full bg-[#FF5C00] text-white font-black py-4 rounded-xl hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-orange-200/60 flex items-center justify-center gap-2 text-sm">
            <span class="material-symbols-outlined text-sm">shopping_cart_checkout</span> Buat Pesanan Sekarang!
          </button>

          <a href="{{ route('keranjang.index') }}" class="block text-center text-sm text-on-surface-variant font-bold mt-4 hover:underline">
            Kembali ke Keranjang
          </a>

          {{-- Trust Badges --}}
          <div class="mt-6 pt-4 border-t border-outline-variant space-y-2">
            <div class="flex items-center gap-2 text-xs text-on-surface-variant">
              <span class="material-symbols-outlined text-tertiary text-sm">verified_user</span> Pembayaran Aman & Terenkripsi
            </div>
            <div class="flex items-center gap-2 text-xs text-on-surface-variant">
              <span class="material-symbols-outlined text-tertiary text-sm">bolt</span> Pengiriman Cepat 15 Menit
            </div>
            <div class="flex items-center gap-2 text-xs text-on-surface-variant">
              <span class="material-symbols-outlined text-tertiary text-sm">replay</span> Garansi Uang Kembali
            </div>
          </div>
        </div>
      </div>

    </div>
  </form>
</div>
@endsection