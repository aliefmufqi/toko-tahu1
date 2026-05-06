<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin TahuBalap - @yield('title', 'Dashboard')</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        "primary": "#a73a00",
        "on-primary": "#ffffff",
        "primary-container": "#ff5c00",
        "on-primary-container": "#521800",
        "primary-fixed": "#ffdbce",
        "primary-fixed-dim": "#ffb59a",
        "secondary": "#7c5800",
        "secondary-fixed": "#ffdea8",
        "on-secondary-fixed-variant": "#5e4200",
        "tertiary": "#2c694e",
        "tertiary-fixed": "#b1f0ce",
        "on-tertiary-fixed-variant": "#0e5138",
        "error": "#ba1a1a",
        "error-container": "#ffdad6",
        "on-error-container": "#93000a",
        "surface": "#fcf9f8",
        "surface-container-lowest": "#ffffff",
        "surface-container-low": "#f6f3f2",
        "surface-container": "#f0eded",
        "surface-container-high": "#eae7e7",
        "surface-variant": "#e5e2e1",
        "on-surface": "#1c1b1b",
        "on-surface-variant": "#5b4137",
        "outline-variant": "#e4beb1",
      },
      fontFamily: { sans: ["Plus Jakarta Sans", "sans-serif"] },
      fontSize: {
        "headline-lg": ["32px", { lineHeight: "1.2", fontWeight: "700" }],
        "headline-md": ["24px", { lineHeight: "1.3", fontWeight: "700" }],
        "body-md": ["16px", { lineHeight: "1.5", fontWeight: "400" }],
        "label-sm": ["12px", { lineHeight: "1", fontWeight: "500" }],
      }
    }
  }
}
</script>
<style>
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
.sidebar-link { @apply text-slate-500 px-4 py-3 flex items-center gap-3 hover:bg-orange-50 transition-colors duration-150 text-sm font-semibold rounded-lg mx-2; }
.sidebar-link.active { @apply bg-orange-50 text-[#FF5C00] border-r-4 border-[#FF5C00] rounded-r-none; }
</style>
@stack('styles')
</head>
<body class="bg-surface-container-lowest text-on-surface font-sans">

<div class="flex min-h-screen">
  {{-- Sidebar --}}
  <aside class="fixed left-0 top-0 h-screen flex flex-col bg-white w-64 border-r border-slate-100 shadow-sm z-50">
    <div class="p-6 flex flex-col gap-1 border-b border-slate-100">
      <span class="text-xl font-black text-[#FF5C00] italic">TahuBalap</span>
      <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Admin Panel</span>
    </div>

    <nav class="flex-1 py-4 space-y-1 overflow-y-auto">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-sm" style="{{ request()->routeIs('admin.dashboard') ? 'font-variation-settings: \"FILL\" 1' : '' }}">dashboard</span> Dashboard
      </a>
      <a href="{{ route('admin.produk.index') }}" class="sidebar-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-sm" style="{{ request()->routeIs('admin.produk.*') ? 'font-variation-settings: \"FILL\" 1' : '' }}">inventory_2</span> Produk
      </a>
      <a href="{{ route('admin.kategori.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-sm" style="{{ request()->routeIs('admin.kategori.*') ? 'font-variation-settings: \"FILL\" 1' : '' }}">category</span> Kategori
      </a>
      <a href="{{ route('admin.pesanan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-sm" style="{{ request()->routeIs('admin.pesanan.*') ? 'font-variation-settings: \"FILL\" 1' : '' }}">shopping_basket</span> Pesanan
      </a>
      <a href="{{ route('admin.user.index') }}" class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined text-sm" style="{{ request()->routeIs('admin.user.*') ? 'font-variation-settings: \"FILL\" 1' : '' }}">group</span> Pengguna
      </a>

      <div class="px-4 pt-4 pb-2">
        <span class="text-[10px] font-black uppercase tracking-widest text-slate-300">Lainnya</span>
      </div>
      <a href="{{ route('home') }}" class="sidebar-link">
        <span class="material-symbols-outlined text-sm">open_in_new</span> Lihat Toko
      </a>
    </nav>

    {{-- User Info --}}
    <div class="p-4 border-t border-slate-100">
      <div class="flex items-center gap-3 px-2 mb-3">
        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-white font-bold">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
          <p class="text-sm font-bold text-on-surface">{{ auth()->user()->name }}</p>
          <p class="text-[10px] text-slate-500 uppercase">Super Admin</p>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="w-full flex items-center gap-2 px-3 py-2 text-sm text-error hover:bg-red-50 rounded-lg transition-colors font-semibold">
          <span class="material-symbols-outlined text-sm">logout</span> Keluar
        </button>
      </form>
    </div>
  </aside>

  {{-- Main Content --}}
  <main class="flex-1 ml-64 min-h-screen">
    <div class="p-10">
      {{-- Page Header --}}
      <header class="flex justify-between items-center mb-10">
        <div>
          <h1 class="text-headline-lg font-black text-on-surface tracking-tight">@yield('title', 'Dashboard')</h1>
          <p class="text-body-md text-on-surface-variant">@yield('subtitle', 'Selamat datang di panel admin TahuBalap')</p>
        </div>
        @yield('header-actions')
      </header>

      {{-- Flash Messages --}}
      @if(session('sukses'))
      <div class="mb-6 bg-tertiary-fixed text-on-tertiary-fixed-variant border border-tertiary-fixed-dim rounded-xl px-5 py-3 flex items-center justify-between font-bold text-sm">
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">check_circle</span> {{ session('sukses') }}</span>
        <button onclick="this.parentElement.remove()" class="material-symbols-outlined text-sm">close</button>
      </div>
      @endif
      @if(session('error'))
      <div class="mb-6 bg-error-container text-on-error-container border border-error/20 rounded-xl px-5 py-3 flex items-center justify-between font-bold text-sm">
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">error</span> {{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="material-symbols-outlined text-sm">close</button>
      </div>
      @endif

      @yield('content')
    </div>
  </main>
</div>

@stack('scripts')
</body>
</html>