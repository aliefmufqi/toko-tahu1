@extends('layouts.admin')
@section('title', 'Edit Pengguna')
@section('subtitle', 'Perbarui data: ' . $user->name)

@section('header-actions')
<a href="{{ route('admin.user.index') }}"
  class="flex items-center gap-2 px-4 py-2 border-2 border-gray-200 text-gray-500 font-bold text-sm rounded-xl hover:bg-gray-50 transition-colors">
  <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali
</a>
@endsection

@section('content')
<div class="max-w-lg">
  <form action="{{ route('admin.user.update', $user) }}" method="POST">
    @csrf @method('PUT')
    <div class="bg-white rounded-xl border border-orange-50 shadow-sm p-8 space-y-5">

      <div>
        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Nama Lengkap *</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"
          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] bg-gray-50 @error('name') border-red-400 @enderror">
        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
      </div>

      <div>
        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Email *</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"
          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] bg-gray-50 @error('email') border-red-400 @enderror">
        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
      </div>

      <div>
        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Role *</label>
        <select name="role" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] bg-gray-50">
          <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
          <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
      </div>

      <div>
        <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Password Baru (Opsional)</label>
        <input type="password" name="password"
          class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF5C00] bg-gray-50"
          placeholder="Kosongkan jika tidak ingin mengubah">
        <p class="text-xs text-gray-400 mt-1">Isi hanya jika ingin mengubah password</p>
      </div>

      <div class="flex gap-4 pt-2">
        <button type="submit"
          class="flex-1 bg-[#FF5C00] text-white font-bold py-3 rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg shadow-orange-200 flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-sm">save</span> Simpan Perubahan
        </button>
        <a href="{{ route('admin.user.index') }}"
          class="px-6 py-3 border-2 border-gray-200 text-gray-500 font-bold rounded-xl hover:bg-gray-50 transition-colors text-center">
          Batal
        </a>
      </div>
    </div>
  </form>
</div>
@endsection