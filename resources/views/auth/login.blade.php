@extends('layouts.app')
@section('title', 'Masuk')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
  <div class="w-full max-w-md">

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-2xl shadow-orange-100/60 border border-outline-variant overflow-hidden">

      {{-- Header Card --}}
      <div class="bg-gradient-to-br from-[#FF5C00] to-[#a73a00] px-8 pt-10 pb-16 text-center relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-white/10 rounded-full"></div>
        <div class="text-5xl mb-3"></div>
        <h1 class="text-2xl font-black text-white italic tracking-tight">TahuBalap</h1>
        <p class="text-white/80 text-sm mt-1 font-medium">Masuk untuk mulai memesan</p>
      </div>

      {{-- Form --}}
      <div class="px-8 pb-8 -mt-6 relative">

        {{-- White inner card --}}
        <div class="bg-white rounded-2xl shadow-lg shadow-orange-100/40 border border-orange-50 p-6 mb-6">

          @if(session('status'))
          <div class="bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-xl px-4 py-3 text-sm font-bold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">check_circle</span> {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Email</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">mail</span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                  class="w-full pl-11 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all @error('email') border-error bg-error-container/20 @else border-outline-variant @enderror"
                  placeholder="email@contoh.com">
              </div>
              @error('email')
              <p class="text-error text-xs mt-1 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
              </p>
              @enderror
            </div>

            {{-- Password --}}
            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Password</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">lock</span>
                <input type="password" name="password" id="password" required
                  class="w-full pl-11 pr-12 py-3 border border-outline-variant rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all @error('password') border-error @enderror"
                  placeholder="••••••••">
                <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors">
                  <span class="material-symbols-outlined text-sm" id="eye-icon">visibility</span>
                </button>
              </div>
              @error('password')
              <p class="text-error text-xs mt-1 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
              </p>
              @enderror
            </div>

            {{-- Remember Me + Forgot --}}
            <div class="flex items-center justify-between">
              <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-outline-variant text-[#FF5C00] focus:ring-[#FF5C00]">
                <span class="text-sm text-on-surface-variant font-medium">Ingat saya</span>
              </label>
              @if(Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-sm text-[#FF5C00] font-bold hover:underline">
                Lupa password?
              </a>
              @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-[#FF5C00] text-white font-black py-4 rounded-xl hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-orange-200/60 flex items-center justify-center gap-2 text-sm mt-2">
              <span class="material-symbols-outlined text-sm">login</span> Masuk Sekarang
            </button>
          </form>
        </div>

        {{-- Daftar Link --}}
        <p class="text-center text-sm text-on-surface-variant">
          Belum punya akun?
          <a href="{{ route('register') }}" class="text-[#FF5C00] font-black hover:underline ml-1">Daftar Gratis</a>
        </p>
      </div>
    </div>

    {{-- Bottom Trust --}}
    <div class="flex justify-center gap-6 mt-6 text-xs text-on-surface-variant">
      <span class="flex items-center gap-1">
        <span class="material-symbols-outlined text-xs text-tertiary">verified_user</span> Aman & Terenkripsi
      </span>
      <span class="flex items-center gap-1">
        <span class="material-symbols-outlined text-xs text-tertiary">bolt</span> Pengiriman 15 Menit
      </span>
    </div>
  </div>
</div>

@push('scripts')
<script>
function togglePassword() {
  const input = document.getElementById('password');
  const icon  = document.getElementById('eye-icon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.textContent = 'visibility_off';
  } else {
    input.type = 'password';
    icon.textContent = 'visibility';
  }
}
</script>
@endpush
@endsection