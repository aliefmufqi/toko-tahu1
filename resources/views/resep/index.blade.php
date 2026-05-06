@extends('layouts.app')
@section('title', 'Resep Tahu')

@section('content')

{{-- Hero Banner --}}
<div style="position:relative; overflow:hidden; border-radius:24px; margin:24px 24px 0; background:linear-gradient(135deg, #8B3A00 0%, #FF5C00 60%, #ff8c42 100%); min-height:260px; display:flex; align-items:center;">
  <div style="position:relative; z-index:2; padding:48px;">
    <h1 style="font-size:42px; font-weight:900; color:white; margin:0 0 12px; line-height:1.1;">Racing to Flavor 🔥</h1>
    <p style="font-size:15px; color:rgba(255,255,255,0.85); margin:0 0 28px; max-width:480px; line-height:1.6;">
      Master the art of the perfect tofu dish with our chef-curated recipes. From spicy street classics to modern fusion, bring TahuBalap home.
    </p>
    <a href="#resep-grid" style="display:inline-flex; align-items:center; gap:8px; background:#FEB700; color:#521800; font-weight:800; font-size:14px; padding:14px 28px; border-radius:50px; text-decoration:none; box-shadow:0 4px 20px rgba(0,0,0,0.2);">
      <span class="material-symbols-outlined" style="font-size:18px;">local_fire_department</span> Explore New Arrivals
    </a>
  </div>
  <div style="position:absolute; right:-20px; top:-20px; font-size:220px; opacity:0.12; z-index:1;">🧀</div>
</div>

<div style="max-width:1200px; margin:0 auto; padding:32px 24px;">
  <div style="display:grid; grid-template-columns:220px 1fr; gap:28px; align-items:start;">

    {{-- Sidebar Kiri --}}
    <div>
      {{-- Kategori --}}
      <div style="background:white; border-radius:16px; border:1px solid #f3f4f6; padding:20px; margin-bottom:20px;">
        <h3 style="font-size:14px; font-weight:800; color:#FF5C00; margin:0 0 16px; text-transform:uppercase; letter-spacing:1px;">Categories</h3>
        <div style="display:flex; flex-direction:column; gap:4px;">
          <a href="{{ route('resep.index') }}" style="padding:10px 14px; background:#FF5C00; color:white; border-radius:10px; font-size:13px; font-weight:700; text-decoration:none; display:block;">
            All Recipes
          </a>
          @foreach($kategoris as $kat)
          <a href="{{ route('resep.index', ['kategori' => $kat]) }}" style="padding:10px 14px; color:#4b5563; border-radius:10px; font-size:13px; font-weight:600; text-decoration:none; display:block; transition:background 0.15s;"
             onmouseover="this.style.background='#fff7ed'; this.style.color='#FF5C00'" onmouseout="this.style.background='transparent'; this.style.color='#4b5563'">
            {{ $kat }}
          </a>
          @endforeach
        </div>
      </div>

      {{-- Weekly Special --}}
      <div style="background:linear-gradient(135deg, #1f4e3d, #2c6e4f); border-radius:16px; padding:20px; color:white;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:12px;">
          <span class="material-symbols-outlined" style="font-size:20px; color:#FEB700;">restaurant</span>
          <span style="font-size:13px; font-weight:800; color:#FEB700;">Weekly Special</span>
        </div>
        <p style="font-size:12px; opacity:0.85; line-height:1.6; margin:0 0 16px;">
          Try our signature "Balap Fire Tofu" — ready in just 15 minutes.
        </p>
        <a href="{{ route('resep.show', 'tahu-gejrot-pedas') }}" style="font-size:12px; font-weight:800; color:#FEB700; text-decoration:underline;">
          Get Cooking →
        </a>
      </div>
    </div>

    {{-- Grid Resep --}}
    <div id="resep-grid">
      <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px; margin-bottom:20px;">
        @foreach($reseps->take(3) as $resep)
        <div style="background:white; border-radius:20px; border:1px solid #f3f4f6; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.05); transition:all 0.2s; cursor:pointer;"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.1)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'">
          {{-- Gambar --}}
          <div style="position:relative; height:170px; background:linear-gradient(135deg, #fff7ed, #ffe4cc); display:flex; align-items:center; justify-content:center; overflow:hidden;">
            @if($resep->gambar)
              <img src="{{ Storage::url($resep->gambar) }}" style="width:100%; height:100%; object-fit:cover;">
            @else
              <span style="font-size:72px;">{{ $resep->emoji }}</span>
            @endif
            <div style="position:absolute; top:10px; left:10px; background:{{ $resep->badge_color }}; color:white; font-size:10px; font-weight:800; padding:4px 10px; border-radius:6px; letter-spacing:1px;">
              {{ $resep->badge }}
            </div>
            <div style="position:absolute; bottom:10px; right:10px; background:rgba(0,0,0,0.7); color:#FEB700; font-size:12px; font-weight:800; padding:4px 10px; border-radius:8px;">
              Rp{{ number_format($resep->harga, 0, ',', '.') }}
            </div>
          </div>
          {{-- Info --}}
          <div style="padding:16px;">
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
              <span style="display:flex; align-items:center; gap:4px; font-size:11px; color:#9ca3af; font-weight:600;">
                <span class="material-symbols-outlined" style="font-size:13px;">schedule</span> {{ $resep['waktu'] }}
              </span>
              <span style="display:flex; align-items:center; gap:4px; font-size:11px; color:#9ca3af; font-weight:600;">
                <span class="material-symbols-outlined" style="font-size:13px;">signal_cellular_alt</span> {{ $resep['level'] }}
              </span>
            </div>
            <h3 style="font-size:16px; font-weight:800; color:#1f2937; margin:0 0 6px; line-height:1.3;">{{ $resep['nama'] }}</h3>
            <p style="font-size:12px; color:#6b7280; margin:0 0 14px; line-height:1.5;">{{ Str::limit($resep['deskripsi'], 80) }}</p>
            <div style="display:flex; align-items:center; gap:8px;">
              <a href="{{ route('resep.show', $resep['slug']) }}"
                style="flex:1; background:#FF5C00; color:white; font-weight:700; font-size:12px; padding:10px; border-radius:10px; text-align:center; text-decoration:none; transition:all 0.15s;"
                onmouseover="this.style.background='#e05000'" onmouseout="this.style.background='#FF5C00'">
                View Full Recipe
              </a>
              <form action="{{ route('keranjang.tambah') }}" method="POST">
                @csrf
                @php $produk = \App\Models\Produk::where('aktif', true)->first(); @endphp
                @if($produk)
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <button style="width:36px; height:36px; background:#fff7ed; border:none; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center;"
                  title="Tambah ke keranjang">
                  <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">shopping_basket</span>
                </button>
                @endif
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- Row ke-2: Resep + Track Widget --}}
      <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px;">
        @foreach($reseps->skip(3)->take(2) as $resep)
        <div style="background:white; border-radius:20px; border:1px solid #f3f4f6; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.05); transition:all 0.2s;"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.1)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'">
          <div style="position:relative; height:170px; background:linear-gradient(135deg, #fff7ed, #ffe4cc); display:flex; align-items:center; justify-content:center;">
            <span style="font-size:72px;">{{ $resep['emoji'] }}</span>
            <div style="position:absolute; top:10px; left:10px; background:{{ $resep['badge_color'] }}; color:white; font-size:10px; font-weight:800; padding:4px 10px; border-radius:6px;">
              {{ $resep['badge'] }}
            </div>
            <div style="position:absolute; bottom:10px; right:10px; background:rgba(0,0,0,0.7); color:#FEB700; font-size:12px; font-weight:800; padding:4px 10px; border-radius:8px;">
              Rp{{ number_format($resep['harga'], 0, ',', '.') }}
            </div>
          </div>
          <div style="padding:16px;">
            <div style="display:flex; gap:12px; margin-bottom:8px;">
              <span style="font-size:11px; color:#9ca3af; font-weight:600; display:flex; align-items:center; gap:3px;">
                <span class="material-symbols-outlined" style="font-size:13px;">schedule</span> {{ $resep['waktu'] }}
              </span>
              <span style="font-size:11px; color:#9ca3af; font-weight:600; display:flex; align-items:center; gap:3px;">
                <span class="material-symbols-outlined" style="font-size:13px;">signal_cellular_alt</span> {{ $resep['level'] }}
              </span>
            </div>
            <h3 style="font-size:16px; font-weight:800; color:#1f2937; margin:0 0 6px;">{{ $resep['nama'] }}</h3>
            <p style="font-size:12px; color:#6b7280; margin:0 0 14px; line-height:1.5;">{{ Str::limit($resep['deskripsi'], 80) }}</p>
            <div style="display:flex; gap:8px;">
              <a href="{{ route('resep.show', $resep['slug']) }}"
                style="flex:1; background:#FF5C00; color:white; font-weight:700; font-size:12px; padding:10px; border-radius:10px; text-align:center; text-decoration:none;"
                onmouseover="this.style.background='#e05000'" onmouseout="this.style.background='#FF5C00'">
                View Full Recipe
              </a>
              <button style="width:36px; height:36px; background:#fff7ed; border:none; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center;">
                <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">shopping_basket</span>
              </button>
            </div>
          </div>
        </div>
        @endforeach

        {{-- Track Widget --}}
        <div style="background:white; border-radius:20px; border:2px dashed #ffe4cc; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:32px 20px; text-align:center;">
          <div style="width:56px; height:56px; background:#fff7ed; border-radius:16px; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
            <span class="material-symbols-outlined" style="font-size:28px; color:#FF5C00;">track_changes</span>
          </div>
          <h3 style="font-size:15px; font-weight:800; color:#1f2937; margin:0 0 8px;">Track Your Ingredients</h3>
          <p style="font-size:12px; color:#9ca3af; margin:0 0 20px; line-height:1.5;">Order ingredients for any recipe and watch them race to your doorstep with our live tracker.</p>
          <div style="width:100%; background:#f3f4f6; border-radius:4px; height:4px; margin-bottom:8px; overflow:hidden;">
            <div style="width:65%; background:#FF5C00; height:100%; border-radius:4px;"></div>
          </div>
          <p style="font-size:11px; color:#9ca3af; margin:0 0 16px;">65% delivered on time</p>
          <a href="{{ route('pesanan.index') }}"
            style="border:2px solid #FF5C00; color:#FF5C00; font-weight:800; font-size:12px; padding:10px 20px; border-radius:10px; text-decoration:none; transition:all 0.15s;"
            onmouseover="this.style.background='#FF5C00'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='#FF5C00'">
            Check My Order Status
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection