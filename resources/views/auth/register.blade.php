@extends('layouts.app')
@section('title', 'Daftar')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
  <div class="w-full max-w-md">

    <div class="bg-white rounded-3xl shadow-2xl shadow-orange-100/60 border border-outline-variant overflow-hidden">

      <div class="bg-gradient-to-br from-[#FF5C00] to-[#a73a00] px-8 pt-10 pb-16 text-center relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-white/10 rounded-full"></div>
        <div class="text-5xl mb-3"></div>
        <h1 class="text-2xl font-black text-white italic tracking-tight">TahuBalap</h1>
        <p class="text-white/80 text-sm mt-1 font-medium">Daftar akun untuk mulai berbelanja tahu yang cepat dan lezat</p>
      </div>

      <div class="px-8 pb-8 -mt-6 relative">
        <div class="bg-white rounded-2xl shadow-lg shadow-orange-100/40 border border-orange-50 p-6 mb-6">

          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Nama</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">person</span>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                  class="w-full pl-11 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all @error('name') border-error bg-error-container/20 @else border-outline-variant @enderror"
                  placeholder="Nama lengkap">
              </div>
              @error('name')
              <p class="text-error text-xs mt-1 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
              </p>
              @enderror
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Email</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">mail</span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                  class="w-full pl-11 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all @error('email') border-error bg-error-container/20 @else border-outline-variant @enderror"
                  placeholder="email@contoh.com">
              </div>
              @error('email')
              <p class="text-error text-xs mt-1 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">error</span> {{ $message }}
              </p>
              @enderror
            </div>

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Password</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">lock</span>
                <input id="password" type="password" name="password" required
                  class="w-full pl-11 pr-12 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all @error('password') border-error @enderror"
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

            <div>
              <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Konfirmasi Password</label>
              <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">lock</span>
                <input id="password-confirm" type="password" name="password_confirmation" required
                  class="w-full pl-11 pr-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] focus:border-[#FF5C00] bg-surface-container-low transition-all border-outline-variant"
                  placeholder="••••••••">
              </div>
            </div>

            <button type="submit" class="w-full bg-[#FF5C00] text-white font-black py-4 rounded-xl hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-orange-200/60 flex items-center justify-center gap-2 text-sm mt-2">
              <span class="material-symbols-outlined text-sm">person_add</span> Daftar Sekarang
            </button>
          </form>
        </div>

        <p class="text-center text-sm text-on-surface-variant">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-[#FF5C00] font-black hover:underline ml-1">Masuk di sini</a>
        </p>
      </div>
    </div>

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
