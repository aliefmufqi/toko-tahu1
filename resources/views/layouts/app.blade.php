<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>TahuBalap - @yield('title', 'Tahu Enak & Segar')</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
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
            "on-secondary": "#ffffff",
            "secondary-container": "#feb700",
            "on-secondary-container": "#6b4b00",
            "secondary-fixed": "#ffdea8",
            "tertiary": "#2c694e",
            "on-tertiary": "#ffffff",
            "tertiary-container": "#629f81",
            "on-tertiary-container": "#003321",
            "tertiary-fixed": "#b1f0ce",
            "tertiary-fixed-dim": "#95d4b3",
            "on-tertiary-fixed-variant": "#0e5138",
            "error": "#ba1a1a",
            "error-container": "#ffdad6",
            "on-error-container": "#93000a",
            "surface": "#fcf9f8",
            "surface-dim": "#dcd9d9",
            "surface-bright": "#fcf9f8",
            "surface-container-lowest": "#ffffff",
            "surface-container-low": "#f6f3f2",
            "surface-container": "#f0eded",
            "surface-container-high": "#eae7e7",
            "surface-container-highest": "#e5e2e1",
            "on-surface": "#1c1b1b",
            "on-surface-variant": "#5b4137",
            "surface-variant": "#e5e2e1",
            "outline": "#8f7065",
            "outline-variant": "#e4beb1",
            "inverse-surface": "#313030",
            "inverse-on-surface": "#f3f0ef",
            "inverse-primary": "#ffb59a",
            "background": "#fcf9f8",
            "on-background": "#1c1b1b",
          },
          borderRadius: {
            "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"
          },
          fontFamily: { sans: ["Plus Jakarta Sans", "sans-serif"] },
          fontSize: {
            "display-lg": ["48px", { lineHeight: "1.1", letterSpacing: "-0.02em", fontWeight: "800" }],
            "headline-lg": ["32px", { lineHeight: "1.2", fontWeight: "700" }],
            "headline-md": ["24px", { lineHeight: "1.3", fontWeight: "700" }],
            "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "500" }],
            "body-md": ["16px", { lineHeight: "1.5", fontWeight: "400" }],
            "label-bold": ["14px", { lineHeight: "1", fontWeight: "700" }],
            "label-sm": ["12px", { lineHeight: "1", fontWeight: "500" }],
          }
        }
      }
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .scroll-hide::-webkit-scrollbar {
      display: none;
    }

    .scroll-hide {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
  @stack('styles')
</head>

<body class="bg-surface text-on-surface font-sans selection:bg-primary-fixed selection:text-on-surface">

  {{-- Top Navigation --}}
  
  <nav class="bg-[#FFFBF7] border-b border-orange-100 shadow-lg shadow-orange-200/20 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <a href="{{ route('home') }}" class="text-2xl font-black text-[#FF5C00] italic tracking-tighter">TahuBalap</a>

    

      <div class="hidden md:flex items-center gap-8">
        <a href="{{ route('home') }}"
          class="font-bold text-sm tracking-tight {{ request()->routeIs('home') ? 'text-[#FF5C00] border-b-2 border-[#FF5C00] pb-1' : 'text-slate-700 hover:text-[#FF5C00]' }} transition-all">Beranda</a>
        <a href="{{ route('produk.index') }}"
          class="font-bold text-sm tracking-tight {{ request()->routeIs('produk.*') ? 'text-[#FF5C00] border-b-2 border-[#FF5C00] pb-1' : 'text-slate-700 hover:text-[#FF5C00]' }} transition-all">Produk</a>
        @auth

          <a href="{{ route('resep.index') }}"
          class="font-bold text-sm tracking-tight {{ request()->routeIs('resep.*') ? 'text-[#FF5C00] border-b-2 border-[#FF5C00] pb-1' : 'text-slate-700 hover:text-[#FF5C00]' }} transition-all">Resep</a>

          @if(!auth()->user()->isAdmin())
            <a href="{{ route('pesanan.index') }}"
              class="font-bold text-sm tracking-tight {{ request()->routeIs('pesanan.*') ? 'text-[#FF5C00] border-b-2 border-[#FF5C00] pb-1' : 'text-slate-700 hover:text-[#FF5C00]' }} transition-all">Pesanan</a>
          @endif
        @endauth
      </div>

      <div class="flex items-center gap-3">
        @auth
          {{-- Keranjang --}}
          @if(!auth()->user()->isAdmin())
            <a href="{{ route('keranjang.index') }}"
              class="relative p-2 text-slate-700 hover:bg-orange-50 rounded-full transition-all">
              <span class="material-symbols-outlined">shopping_cart</span>
              @if(count(session('keranjang', [])) > 0)
                <span
                  class="absolute -top-1 -right-1 bg-[#FF5C00] text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center">{{ count(session('keranjang', [])) }}</span>
              @endif
            </a>
          @endif

          {{-- User Dropdown --}}
          <div class="relative group">
            <button class="flex items-center gap-2 p-2 hover:bg-orange-50 rounded-full transition-all">
              <div
                class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
            </button>
            <div
              class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-outline-variant opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
              <div class="p-3 border-b border-outline-variant">
                <p class="font-bold text-sm text-on-surface">{{ auth()->user()->name }}</p>
                <p class="text-xs text-on-surface-variant">{{ auth()->user()->email }}</p>
              </div>
              @if(!auth()->user()->isAdmin())
                <a href="{{ route('pesanan.index') }}"
                  class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-orange-50 transition-colors">
                  <span class="material-symbols-outlined text-sm">receipt_long</span> Pesanan Saya
                </a>
              @endif
              @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                  class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-orange-50 text-[#FF5C00] font-bold transition-colors">
                  <span class="material-symbols-outlined text-sm">admin_panel_settings</span> Admin Panel
                </a>
              @endif
              <form action="{{ route('logout') }}" method="POST" class="border-t border-outline-variant">
                @csrf
                <button
                  class="w-full flex items-center gap-2 px-4 py-3 text-sm hover:bg-red-50 text-error transition-colors">
                  <span class="material-symbols-outlined text-sm">logout</span> Keluar
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}"
            class="font-bold text-sm text-slate-700 hover:text-[#FF5C00] transition-colors">Masuk</a>
          <a href="{{ route('register') }}"
            class="bg-primary-container text-white font-bold text-sm px-5 py-2 rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-orange-200">Daftar</a>
        @endauth
      </div>
    </div>
  </nav>

  {{-- Flash Message --}}
  @if(session('sukses'))
    <div class="max-w-7xl mx-auto px-6 pt-4">
      <div
        class="bg-tertiary-fixed text-on-tertiary-fixed-variant border border-tertiary-fixed-dim rounded-xl px-5 py-3 flex items-center justify-between font-bold text-sm">
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">check_circle</span>
          {{ session('sukses') }}</span>
        <button onclick="this.parentElement.remove()" class="material-symbols-outlined text-sm">close</button>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="max-w-7xl mx-auto px-6 pt-4">
      <div
        class="bg-error-container text-on-error-container border border-error/20 rounded-xl px-5 py-3 flex items-center justify-between font-bold text-sm">
        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">error</span>
          {{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" class="material-symbols-outlined text-sm">close</button>
      </div>
    </div>
  @endif

  @if(session('cart_success'))
    <script>
      alert({!! json_encode(session('cart_success')) !!});
    </script>
  @endif

  @if(session('order_success'))
    <script>
      alert({!! json_encode(session('order_success')) !!});
    </script>
  @endif

  @if(session('payment_success'))
    <script>
      alert({!! json_encode(session('payment_success')) !!});
    </script>
  @endif

  @if(session('cart_remove_success'))
    <script>
      alert({!! json_encode(session('cart_remove_success')) !!});
    </script>
  @endif

  <main>
    {{-- Flash Message HARUS di sini --}}
    @if(session('sukses'))
      <div class="max-w-7xl mx-auto px-6 pt-4">
        <div
          class="bg-green-100 text-green-800 border border-green-200 rounded-xl px-5 py-4 flex items-center justify-between font-bold text-sm">
          <span class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            {{ session('sukses') }}
          </span>
          <button onclick="this.parentElement.remove()">
            <span class="material-symbols-outlined text-sm">close</span>
          </button>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="max-w-7xl mx-auto px-6 pt-4">
        <div
          class="bg-red-100 text-red-800 border border-red-200 rounded-xl px-5 py-4 flex items-center justify-between font-bold text-sm">
          <span class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">error</span>
            {{ session('error') }}
          </span>
          <button onclick="this.parentElement.remove()">
            <span class="material-symbols-outlined text-sm">close</span>
          </button>
        </div>
      </div>
    @endif

    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="bg-slate-50 border-t border-slate-200 mt-20">
    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center gap-8">
      <div class="flex flex-col items-center md:items-start gap-2">
        <div class="text-xl font-black text-[#FF5C00] italic">TahuBalap</div>
        <p class="text-xs uppercase tracking-widest text-slate-500">© {{ date('Y') }} TahuBalap. Freshly Racing to Your
          Table.</p>
      </div>
      <div class="flex flex-wrap justify-center gap-8">
        <a href="#"
          class="text-xs uppercase tracking-widest text-slate-500 hover:text-[#FF5C00] underline decoration-[#FF5C00] decoration-2 underline-offset-4 opacity-80 hover:opacity-100 transition-opacity">Kebijakan
          Privasi</a>
        <a href="#"
          class="text-xs uppercase tracking-widest text-slate-500 hover:text-[#FF5C00] underline decoration-[#FF5C00] decoration-2 underline-offset-4 opacity-80 hover:opacity-100 transition-opacity">Syarat
          & Ketentuan</a>
        <a href="#"
          class="text-xs uppercase tracking-widest text-slate-500 hover:text-[#FF5C00] underline decoration-[#FF5C00] decoration-2 underline-offset-4 opacity-80 hover:opacity-100 transition-opacity">Hubungi
          Kami</a>
      </div>
    </div>
  </footer>

  {{-- Mobile Bottom Nav --}}
  <div
    class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 px-6 py-3 flex justify-between items-center z-50">
    <a href="{{ route('home') }}"
      class="flex flex-col items-center gap-1 {{ request()->routeIs('home') ? 'text-[#FF5C00]' : 'text-slate-400' }}">
      <span class="material-symbols-outlined"
        style="{{ request()->routeIs('home') ? 'font-variation-settings: \"FILL\" 1' : '' }}">home</span>
      <span class="text-[10px] font-bold uppercase">Home</span>
    </a>
    <a href="{{ route('produk.index') }}"
      class="flex flex-col items-center gap-1 {{ request()->routeIs('produk.*') ? 'text-[#FF5C00]' : 'text-slate-400' }}">
      <span class="material-symbols-outlined">search</span>
      <span class="text-[10px] font-bold uppercase">Produk</span>
    </a>
    @auth
      @if(!auth()->user()->isAdmin())
        <a href="{{ route('keranjang.index') }}"
          class="flex flex-col items-center gap-1 relative {{ request()->routeIs('keranjang.*') ? 'text-[#FF5C00]' : 'text-slate-400' }}">
          <span class="material-symbols-outlined">shopping_bag</span>
          @if(count(session('keranjang', [])) > 0)
            <span
              class="absolute -top-1 right-0 bg-[#FF5C00] text-white text-[8px] font-black w-4 h-4 rounded-full flex items-center justify-center">{{ count(session('keranjang', [])) }}</span>
          @endif
          <span class="text-[10px] font-bold uppercase">Keranjang</span>
        </a>
        <a href="{{ route('pesanan.index') }}" class="flex flex-col items-center gap-1 text-slate-400">
          <span class="material-symbols-outlined">receipt_long</span>
          <span class="text-[10px] font-bold uppercase">Pesanan</span>
        </a>
      @endif
    @else
      <a href="{{ route('login') }}" class="flex flex-col items-center gap-1 text-slate-400">
        <span class="material-symbols-outlined">person</span>
        <span class="text-[10px] font-bold uppercase">Masuk</span>
      </a>
    @endauth
  </div>
  <div class="md:hidden h-16"></div>

  @stack('scripts')
</body>

</html>