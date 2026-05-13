@extends('layouts.app')
@section('title', $resep['nama'])

@section('content')
<div style="max-width:900px; margin:0 auto; padding:32px 24px;">

  <a href="{{ route('resep.index') }}" style="display:inline-flex; align-items:center; gap:6px; color:#FF5C00; font-weight:700; font-size:13px; text-decoration:none; margin-bottom:24px;">
    <span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span> Kembali ke Resep
  </a>

  <div style="display:grid; grid-template-columns:1fr 1fr; gap:32px; align-items:start;">

          {{-- Gambar & Info --}}
                  <div style="position:relative; height:320px; background:linear-gradient(135deg, #fff7ed, #ffe4cc); border-radius:24px; display:flex; align-items:center; justify-content:center; margin-bottom:20px; overflow:hidden;">
                @if($resep->gambar)
                  <img src="{{ \App\Helpers\UploadHelper::url($resep->gambar) }}" style="width:100%; height:100%; object-fit:cover; border-radius:24px;">
                @else
                  <span style="font-size:140px;">{{ $resep->emoji }}</span>
                @endif
              <div style="position:absolute; top:16px; left:16px; background:{{ $resep->badge_color }}; color:white; font-size:11px; font-weight:800; padding:6px 14px; border-radius:8px; letter-spacing:1px;">
                {{ $resep->badge }}
                </div>
              </div>

      {{-- Meta --}}
      <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px; margin-bottom:20px;">
        <div style="background:white; border:1px solid #f3f4f6; border-radius:12px; padding:14px; text-align:center;">
          <span class="material-symbols-outlined" style="font-size:20px; color:#FF5C00; display:block; margin-bottom:4px;">schedule</span>
          <p style="font-size:12px; color:#9ca3af; margin:0 0 2px; font-weight:600; text-transform:uppercase;">Waktu</p>
          <p style="font-size:14px; font-weight:800; color:#1f2937; margin:0;">{{ $resep['waktu'] }}</p>
        </div>
        <div style="background:white; border:1px solid #f3f4f6; border-radius:12px; padding:14px; text-align:center;">
          <span class="material-symbols-outlined" style="font-size:20px; color:#FF5C00; display:block; margin-bottom:4px;">signal_cellular_alt</span>
          <p style="font-size:12px; color:#9ca3af; margin:0 0 2px; font-weight:600; text-transform:uppercase;">Level</p>
          <p style="font-size:14px; font-weight:800; color:#1f2937; margin:0;">{{ $resep['level'] }}</p>
        </div>
        <div style="background:white; border:1px solid #f3f4f6; border-radius:12px; padding:14px; text-align:center;">
          <span class="material-symbols-outlined" style="font-size:20px; color:#FF5C00; display:block; margin-bottom:4px;">category</span>
          <p style="font-size:12px; color:#9ca3af; margin:0 0 2px; font-weight:600; text-transform:uppercase;">Kategori</p>
          <p style="font-size:13px; font-weight:800; color:#1f2937; margin:0;">{{ $resep['kategori'] }}</p>
        </div>
      </div>

      {{-- Bahan --}}
      <div style="background:white; border:1px solid #f3f4f6; border-radius:16px; padding:24px;">
        <h3 style="font-size:16px; font-weight:800; color:#1f2937; margin:0 0 16px; display:flex; align-items:center; gap:8px;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">format_list_bulleted</span> Bahan-Bahan
        </h3>
        <ul style="margin:0; padding:0; list-style:none; display:flex; flex-direction:column; gap:10px;">
          @foreach($resep['bahan'] as $bahan)
          <li style="display:flex; align-items:center; gap:10px; font-size:13px; color:#374151; font-weight:500; padding-bottom:10px; border-bottom:1px solid #f9fafb;">
            <span style="width:8px; height:8px; background:#FF5C00; border-radius:50%; flex-shrink:0;"></span>
            {{ $bahan }}
          </li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- Langkah & Tips --}}
    <div>
      <span style="display:inline-block; background:#fff7ed; color:#FF5C00; font-size:11px; font-weight:800; padding:6px 14px; border-radius:8px; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px;">
        {{ $resep['kategori'] }}
      </span>
      <h1 style="font-size:28px; font-weight:900; color:#1f2937; margin:0 0 12px; line-height:1.2;">{{ $resep['nama'] }}</h1>
      <p style="font-size:14px; color:#6b7280; margin:0 0 28px; line-height:1.7;">{{ $resep['deskripsi'] }}</p>

      {{-- Langkah --}}
      <div style="background:white; border:1px solid #f3f4f6; border-radius:16px; padding:24px; margin-bottom:20px;">
        <h3 style="font-size:16px; font-weight:800; color:#1f2937; margin:0 0 20px; display:flex; align-items:center; gap:8px;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">restaurant</span> Cara Membuat
        </h3>
        <div style="display:flex; flex-direction:column; gap:16px;">
          @foreach($resep['langkah'] as $i => $langkah)
          <div style="display:flex; gap:14px; align-items:flex-start;">
            <div style="width:28px; height:28px; background:#FF5C00; color:white; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:13px; flex-shrink:0;">
              {{ $i + 1 }}
            </div>
            <p style="font-size:13px; color:#374151; margin:0; line-height:1.6; padding-top:4px;">{{ $langkah }}</p>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Tips --}}
      <div style="background:linear-gradient(135deg, #FEB700, #FF8C00); border-radius:16px; padding:20px; margin-bottom:20px;">
        <h4 style="font-size:14px; font-weight:800; color:#521800; margin:0 0 8px; display:flex; align-items:center; gap:6px;">
          <span class="material-symbols-outlined" style="font-size:16px;">lightbulb</span> Chef's Tips
        </h4>
        <p style="font-size:13px; color:#521800; margin:0; line-height:1.6; opacity:0.85;">{{ $resep['tips'] }}</p>
      </div>

      {{-- CTA Order --}}
      <div style="background:white; border:1px solid #f3f4f6; border-radius:16px; padding:20px; text-align:center;">
        <p style="font-size:13px; color:#6b7280; margin:0 0 12px; font-weight:600;">Tidak mau repot masak? Pesan langsung!</p>
        <a href="{{ route('produk.index') }}"
          style="display:inline-flex; align-items:center; gap:8px; background:#FF5C00; color:white; font-weight:800; font-size:14px; padding:14px 28px; border-radius:12px; text-decoration:none; box-shadow:0 4px 12px rgba(255,92,0,0.3);">
          <span class="material-symbols-outlined" style="font-size:18px;">shopping_bag</span> Pesan Tahu Sekarang
        </a>
      </div>
    </div>
  </div>

  {{-- Resep Lainnya --}}
  <div style="margin-top:48px;">
    <h2 style="font-size:22px; font-weight:800; color:#1f2937; margin:0 0 20px;">Resep Lainnya 👇</h2>
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">
      @foreach(collect($reseps)->where('slug', '!=', $resep['slug'])->take(3) as $r)
      <a href="{{ route('resep.show', $r['slug']) }}"
        style="background:white; border:1px solid #f3f4f6; border-radius:16px; padding:16px; display:flex; align-items:center; gap:12px; text-decoration:none; transition:all 0.2s;"
        onmouseover="this.style.borderColor='#FF5C00'; this.style.background='#fff7ed'"
        onmouseout="this.style.borderColor='#f3f4f6'; this.style.background='white'">
        <span style="font-size:36px;">{{ $r['emoji'] }}</span>
        <div>
          <p style="font-size:13px; font-weight:800; color:#1f2937; margin:0 0 3px;">{{ $r['nama'] }}</p>
          <p style="font-size:11px; color:#9ca3af; margin:0; font-weight:600;">{{ $r['waktu'] }} · {{ $r['level'] }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
@endsection