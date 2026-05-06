@extends('layouts.admin')
@section('title', 'Manajemen Pengguna')
@section('subtitle', 'Kelola semua akun pengguna')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
  <div class="bg-white rounded-2xl border border-orange-50 shadow-sm p-5">
    <p class="text-xs text-gray-400 font-bold uppercase mb-1">Total Pengguna</p>
    <p class="text-3xl font-black text-on-surface">{{ $users->total() }}</p>
  </div>
  <div class="bg-white rounded-2xl border border-orange-50 shadow-sm p-5">
    <p class="text-xs text-gray-400 font-bold uppercase mb-1">Customer</p>
    <p class="text-3xl font-black text-on-surface">{{ \App\Models\User::where('role','customer')->count() }}</p>
  </div>
  <div class="bg-white rounded-2xl border border-orange-50 shadow-sm p-5">
    <p class="text-xs text-gray-400 font-bold uppercase mb-1">Admin</p>
    <p class="text-3xl font-black text-on-surface">{{ \App\Models\User::where('role','admin')->count() }}</p>
  </div>
  <div class="bg-white rounded-2xl border border-orange-50 shadow-sm p-5">
    <p class="text-xs text-gray-400 font-bold uppercase mb-1">Baru Bulan Ini</p>
    <p class="text-3xl font-black text-on-surface">{{ \App\Models\User::whereMonth('created_at', now()->month)->count() }}</p>
  </div>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-orange-50 shadow-sm overflow-hidden">
  <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h3 class="font-bold text-on-surface">Daftar Pengguna</h3>
    <div class="flex gap-3">
      <div class="relative">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">search</span>
        <input type="text" placeholder="Cari pengguna..."
          class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm w-56 focus:ring-2 focus:ring-[#FF5C00] focus:outline-none"/>
      </div>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-left">
      <thead class="bg-gray-50 text-gray-400 font-bold text-xs uppercase tracking-widest border-b border-gray-100">
        <tr>
          <th class="px-6 py-4">Pengguna</th>
          <th class="px-6 py-4">Role</th>
          <th class="px-6 py-4">Telepon</th>
          <th class="px-6 py-4">Total Pesanan</th>
          <th class="px-6 py-4">Bergabung</th>
          <th class="px-6 py-4">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($users as $user)
        <tr class="hover:bg-orange-50/30 transition-colors">
          <td class="px-6 py-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-sm
                {{ $user->role === 'admin' ? 'bg-[#FF5C00] text-white' : 'bg-orange-100 text-[#FF5C00]' }}">
                {{ strtoupper(substr($user->name, 0, 1)) }}
              </div>
              <div>
                <p class="font-bold text-sm text-on-surface">{{ $user->name }}</p>
                <p class="text-xs text-gray-400">{{ $user->email }}</p>
              </div>
            </div>
          </td>
          <td class="px-6 py-4">
            @if($user->role === 'admin')
              <span class="bg-[#FF5C00] text-white text-xs font-bold px-3 py-1 rounded-full">Admin</span>
            @else
              <span class="bg-orange-100 text-[#FF5C00] text-xs font-bold px-3 py-1 rounded-full">Customer</span>
            @endif
          </td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ $user->telepon ?? '-' }}</td>
          <td class="px-6 py-4">
            <span class="font-bold text-sm">{{ $user->pesanans->count() }} pesanan</span>
          </td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
          <td class="px-6 py-4">
            <div class="flex gap-2">
              <a href="{{ route('admin.user.show', $user) }}"
                class="p-2 bg-blue-50 text-blue-500 hover:bg-blue-100 rounded-lg transition-colors" title="Detail">
                <span class="material-symbols-outlined text-sm">visibility</span>
              </a>
              <a href="{{ route('admin.user.edit', $user) }}"
                class="p-2 bg-gray-100 hover:bg-orange-100 hover:text-[#FF5C00] rounded-lg transition-colors" title="Edit">
                <span class="material-symbols-outlined text-sm">edit</span>
              </a>
              @if($user->id !== auth()->id())
              <form action="{{ route('admin.user.destroy', $user) }}" method="POST"
                onsubmit="return confirm('Yakin hapus pengguna ini?')">
                @csrf @method('DELETE')
                <button class="p-2 bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                  <span class="material-symbols-outlined text-sm">delete</span>
                </button>
              </form>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-20 text-center">
            <span class="text-5xl block mb-4">👥</span>
            <p class="font-bold text-gray-400">Belum ada pengguna</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($users->hasPages())
  <div class="p-6 border-t border-gray-100 flex justify-center">
    {{ $users->links() }}
  </div>
  @endif
</div>
@endsection