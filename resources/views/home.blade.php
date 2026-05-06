@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<header class="relative overflow-hidden bg-surface-container-low">
  <div class="max-w-7xl mx-auto px-6 py-16 md:py-24 grid md:grid-cols-2 gap-12 items-center">
    <div class="z-10">
      <span class="inline-block px-4 py-1.5 mb-6 rounded-full bg-secondary-container text-on-secondary-container font-bold text-xs uppercase tracking-wider">
        {{ \App\Models\Setting::get('hero_badge', 'Freshly Racing to Your Table 🏎️') }}
      </span>
      <h1 class="text-display-lg font-black text-on-surface mb-6">
        {!! \App\Models\Setting::get('hero_title', 'Rasakan <span class="text-primary-container">Tahu Balap</span> yang Cepat & Lezat') !!}
      </h1>
      <p class="text-body-lg text-on-surface-variant mb-10 max-w-lg">
        {{ \App\Models\Setting::get('hero_subtitle', 'Nikmati cita rasa street food otentik dengan standar kebersihan modern.') }}
      </p>
      <div class="flex flex-wrap gap-4">
        <a href="{{ route('produk.index') }}" class="bg-primary-container text-white font-bold text-sm px-8 py-4 rounded-xl shadow-lg shadow-orange-200/40 hover:scale-105 active:scale-95 transition-all">
          Pesan Sekarang
        </a>
        <a href="{{ route('produk.index') }}" class="border-2 border-primary-container text-primary-container font-bold text-sm px-8 py-4 rounded-xl hover:bg-primary-fixed transition-all">
          Lihat Menu
        </a>
      </div>
    </div>

    {{-- Gambar Hero --}}
    <div class="relative flex items-center justify-center">
      @php $heroImage = \App\Models\Setting::get('hero_image'); @endphp
      @if($heroImage)
      <div class="w-full max-w-lg mx-auto" style="transform: rotate(7deg);">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl" style="aspect-ratio:1/1;">
          <img src="{{ Storage::url($heroImage) }}" class="w-full h-full object-cover object-center">
        </div>
      </div>
      @else
      <div class="w-full aspect-square max-w-md bg-primary-fixed rounded-[2rem] flex items-center justify-center text-8xl shadow-2xl rotate-3">
        🧀
      </div>
      @endif

      <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-4">
        <div class="bg-tertiary-container p-3 rounded-full">
          <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1">bolt</span>
        </div>
        <div>
          <p class="font-bold text-sm text-on-surface">Pengiriman 15 Menit</p>
          <p class="text-xs text-on-surface-variant">Tercepat di kota</p>
        </div>
      </div>
    </div>
  </div>
</header>

{{-- Category Navigation --}}
<section class="bg-surface py-12">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-headline-md font-bold mb-8 text-on-surface">Jelajahi Kategori</h2>
    <div class="flex gap-4 overflow-x-auto scroll-hide pb-4">
      <a href="{{ route('produk.index') }}" class="flex-none flex items-center gap-3 px-6 py-3 rounded-full bg-primary-container text-white font-bold text-sm transition-all hover:scale-105">
        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1">local_fire_department</span> Semua
      </a>
      @foreach($kategoris as $kat)
      <a href="{{ route('produk.index', ['kategori' => $kat->slug]) }}" class="flex-none flex items-center gap-3 px-6 py-3 rounded-full bg-surface-container hover:bg-primary-fixed-dim text-on-surface-variant font-bold text-sm transition-all">
        <span class="material-symbols-outlined text-sm">restaurant</span> {{ $kat->nama }}
      </a>
      @endforeach
    </div>
  </div>
</section>

{{-- Featured Dishes - Bento Grid --}}
<section class="max-w-7xl mx-auto px-6 py-12">
  <div class="flex items-center justify-between mb-10">
    <div>
      <h2 class="text-headline-lg font-bold text-on-surface">Produk Unggulan</h2>
      <p class="text-on-surface-variant text-body-md">Favorit pelanggan kami hari ini</p>
    </div>
    <a href="{{ route('produk.index') }}" class="text-primary-container font-bold text-sm flex items-center gap-2 group">
      Lihat semua <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
    </a>
  </div>

  @if($produkUnggulan->count() > 0)
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    {{-- Featured Large Item (produk pertama) --}}
    @php $featured = $produkUnggulan->first(); @endphp
    <div class="md:col-span-2 md:row-span-2 bg-white rounded-3xl p-6 shadow-sm border border-outline-variant flex flex-col group hover:shadow-xl transition-all">
      <div class="relative overflow-hidden rounded-2xl mb-6 aspect-video bg-primary-fixed flex items-center justify-center">
        @if($featured->gambar)
          <img src="{{ Storage::url($featured->gambar) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $featured->nama }}">
        @else
          <span class="text-8xl">🧀</span>
        @endif
        <span class="absolute top-4 right-4 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold">MUST TRY</span>
      </div>
      <div class="flex justify-between items-start mb-4">
        <div>
          <h3 class="text-headline-md font-bold mb-1">{{ $featured->nama }}</h3>
          <div class="flex items-center gap-1 text-secondary">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1">star</span>
            <span class="font-bold text-sm">4.9</span>
            <span class="text-on-surface-variant text-sm ml-1">(120+ ulasan)</span>
          </div>
        </div>
        <span class="text-primary-container font-bold text-headline-md">Rp{{ number_format($featured->harga, 0, ',', '.') }}</span>
      </div>
      <p class="text-on-surface-variant mb-6 flex-grow text-sm">{{ Str::limit($featured->deskripsi, 100) }}</p>
      <form action="{{ route('keranjang.tambah') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $featured->id }}">
        <button class="w-full bg-on-surface text-white py-4 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-primary-container active:scale-95 transition-all">
          <span class="material-symbols-outlined text-sm">add_shopping_cart</span> Tambah ke Keranjang
        </button>
      </form>
    </div>

    {{-- Smaller Items --}}
    @foreach($produkUnggulan->skip(1)->take(4) as $produk)
    <div class="bg-white rounded-3xl p-4 shadow-sm border border-outline-variant group hover:shadow-lg transition-all">
      <div class="relative overflow-hidden rounded-xl mb-4 aspect-square bg-primary-fixed flex items-center justify-center">
        @if($produk->gambar)
          <img src="{{ Storage::url($produk->gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform" alt="{{ $produk->nama }}">
        @else
          <span class="text-5xl">🧀</span>
        @endif
      </div>
      <h4 class="font-bold text-sm mb-1">{{ $produk->nama }}</h4>
      <div class="flex items-center justify-between mb-3">
        <div class="flex items-center gap-1 text-secondary">
          <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1">star</span>
          <span class="text-xs font-bold">4.7</span>
        </div>
        <span class="font-bold text-primary text-sm">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
      </div>
      <form action="{{ route('keranjang.tambah') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <button class="w-full bg-surface-container hover:bg-primary-fixed font-bold text-xs py-2 rounded-xl transition-all flex items-center justify-center gap-1">
          <span class="material-symbols-outlined text-xs">add</span> Tambah
        </button>
      </form>
    </div>
    @endforeach
  </div>
  @else
  <div class="text-center py-16 text-on-surface-variant">
    <span class="text-6xl block mb-4">🧀</span>
    <p class="font-bold">Belum ada produk tersedia</p>
  </div>
  @endif
</section>

{{-- Why TahuBalap --}}
<section class="bg-surface-container-low py-20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-headline-lg font-bold text-on-surface mb-3">Kenapa Pilih Tahu Balap?</h2>
      <p class="text-on-surface-variant text-body-md max-w-xl mx-auto">Kami berkomitmen menghadirkan tahu terbaik dengan pengalaman belanja yang menyenangkan</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white p-8 rounded-2xl border border-outline-variant text-center">
        <div class="w-16 h-16 bg-primary-fixed rounded-2xl flex items-center justify-center mx-auto mb-4">
          <span class="material-symbols-outlined text-primary-container text-2xl" style="font-variation-settings: 'FILL' 1">bolt</span>
        </div>
        <h3 class="font-bold text-body-lg mb-2">Super Cepat</h3>
        <p class="text-on-surface-variant text-sm">Pengiriman dalam 15 menit ke lokasi Anda. Tahu masih panas sampai di tangan!</p>
      </div>
      <div class="bg-white p-8 rounded-2xl border border-outline-variant text-center">
        <div class="w-16 h-16 bg-tertiary-fixed rounded-2xl flex items-center justify-center mx-auto mb-4">
          <span class="material-symbols-outlined text-tertiary text-2xl" style="font-variation-settings: 'FILL' 1">verified</span>
        </div>
        <h3 class="font-bold text-body-lg mb-2">Kualitas Terjamin</h3>
        <p class="text-on-surface-variant text-sm">Bahan baku segar setiap hari dari pengrajin tahu terpercaya lokal.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl border border-outline-variant text-center">
        <div class="w-16 h-16 bg-secondary-fixed rounded-2xl flex items-center justify-center mx-auto mb-4">
          <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1">payments</span>
        </div>
        <h3 class="font-bold text-body-lg mb-2">Harga Terjangkau</h3>
        <p class="text-on-surface-variant text-sm">Harga street food yang bersahabat dengan kualitas yang tidak murahan.</p>
      </div>
    </div>
  </div>
</section>

@endsection