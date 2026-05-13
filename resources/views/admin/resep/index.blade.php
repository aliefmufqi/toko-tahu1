@extends('layouts.admin')
@section('title', 'Manajemen Resep')
@section('subtitle', 'Kelola semua resep tahu TahuBalap')

@section('header-actions')
<a href="{{ route('admin.resep.create') }}"
  style="display:flex; align-items:center; gap:8px; padding:10px 20px; background:#FF5C00; color:white; font-weight:800; font-size:13px; border-radius:12px; text-decoration:none; box-shadow:0 4px 12px rgba(255,92,0,0.3);">
  <span class="material-symbols-outlined" style="font-size:16px;">add</span> Tambah Resep
</a>
@endsection

@section('content')
<div style="background:white; border-radius:16px; border:1px solid #f3f4f6; overflow:hidden;">

  <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
    <p style="margin:0; font-size:14px; color:#6b7280;">Total <strong>{{ $reseps->total() }}</strong> resep</p>
  </div>

  <div style="overflow-x:auto;">
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="background:#f9fafb; border-bottom:1px solid #f3f4f6;">
          <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">Resep</th>
          <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">Kategori</th>
          <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">Waktu</th>
          <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">Level</th>
          <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">Status</th>
          <th style="padding:12px 24px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reseps as $resep)
        <tr style="border-bottom:1px solid #f9fafb; transition:background 0.15s;"
          onmouseover="this.style.background='#fffbf7'" onmouseout="this.style.background='white'">
          <td style="padding:16px 24px;">
            <div style="display:flex; align-items:center; gap:12px;">
              <div style="width:48px; height:48px; border-radius:12px; background:#fff7ed; display:flex; align-items:center; justify-content:center; font-size:24px; flex-shrink:0; overflow:hidden;">
                @if($resep->gambar)
                  <img src="{{ \App\Helpers\UploadHelper::url($resep->gambar) }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                  {{ $resep->emoji }}
                @endif
              </div>
              <div>
                <p style="font-size:14px; font-weight:800; color:#1f2937; margin:0 0 4px;">{{ $resep->nama }}</p>
                <span style="background:{{ $resep->badge_color }}; color:white; font-size:10px; font-weight:800; padding:2px 8px; border-radius:4px;">
                  {{ $resep->badge }}
                </span>
              </div>
            </div>
          </td>
          <td style="padding:16px;">
            <span style="background:#f3f4f6; color:#4b5563; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px;">
              {{ $resep->kategori }}
            </span>
          </td>
          <td style="padding:16px; font-size:13px; color:#6b7280; font-weight:600;">{{ $resep->waktu }} min</td>
          <td style="padding:16px; font-size:13px; color:#6b7280; font-weight:600;">{{ $resep->level }}</td>
          <td style="padding:16px;">
            @if($resep->aktif)
              <span style="background:#f0fdf4; color:#16a34a; font-size:12px; font-weight:800; padding:4px 12px; border-radius:20px;">Aktif</span>
            @else
              <span style="background:#fef2f2; color:#ef4444; font-size:12px; font-weight:800; padding:4px 12px; border-radius:20px;">Nonaktif</span>
            @endif
          </td>
          <td style="padding:16px 24px;">
            <div style="display:flex; gap:8px;">
              <a href="{{ route('admin.resep.edit', $resep) }}"
                style="width:34px; height:34px; background:#f3f4f6; border-radius:8px; display:flex; align-items:center; justify-content:center; text-decoration:none; transition:background 0.15s;"
                onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='#f3f4f6'">
                <span class="material-symbols-outlined" style="font-size:16px; color:#6b7280;">edit</span>
              </a>
              <form action="{{ route('admin.resep.destroy', $resep) }}" method="POST"
                onsubmit="return confirm('Yakin hapus resep ini?')">
                @csrf @method('DELETE')
                <button style="width:34px; height:34px; background:#fef2f2; border:none; border-radius:8px; cursor:pointer; display:flex; align-items:center; justify-content:center;">
                  <span class="material-symbols-outlined" style="font-size:16px; color:#ef4444;">delete</span>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="padding:48px; text-align:center;">
            <div style="font-size:48px; margin-bottom:12px;">📖</div>
            <p style="font-weight:700; color:#9ca3af; margin:0 0 16px;">Belum ada resep</p>
            <a href="{{ route('admin.resep.create') }}"
              style="background:#FF5C00; color:white; font-weight:800; font-size:13px; padding:10px 24px; border-radius:10px; text-decoration:none;">
              + Tambah Resep Pertama
            </a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($reseps->hasPages())
  <div style="padding:20px; border-top:1px solid #f3f4f6; display:flex; justify-content:center;">
    {{ $reseps->links() }}
  </div>
  @endif
</div>
@endsection