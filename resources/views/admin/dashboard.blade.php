@extends('layouts.admin')
@section('title', 'DASHBOARD ADMIN')
@section('subtitle', 'Selamat datang kembali, Admin!')

@section('header-actions')
  <div style="display:flex; gap:12px;">
    <a href="{{ route('admin.produk.index') }}"
      style="display:flex; align-items:center; gap:8px; padding:10px 20px; border:2px solid #FF5C00; color:#FF5C00; font-weight:800; font-size:13px; border-radius:12px; text-decoration:none; transition:all 0.2s;"
      onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='none'">
      <span class="material-symbols-outlined" style="font-size:16px;">restaurant_menu</span> Kelola Produk
    </a>
    <button
      style="display:flex; align-items:center; gap:8px; padding:10px 20px; background:#FF5C00; color:white; font-weight:800; font-size:13px; border-radius:12px; border:none; cursor:pointer; box-shadow:0 4px 12px rgba(255,92,0,0.3);">
      <span class="material-symbols-outlined" style="font-size:16px;">download</span> Export Report
    </button>
  </div>
@endsection

@section('content')

  {{-- STAT CARDS --}}
  <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:24px;">

    {{-- Total Sales --}}
    <div
      style="background:white; border-radius:16px; padding:24px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04); position:relative; overflow:hidden;">
      <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
        <div
          style="width:44px; height:44px; background:#fff7ed; border-radius:12px; display:flex; align-items:center; justify-content:center;">
          <span class="material-symbols-outlined" style="color:#FF5C00; font-size:22px;">payments</span>
        </div>
        <!-- <span style="background:#f0fdf4; color:#16a34a; font-size:11px; font-weight:800; padding:4px 10px; border-radius:20px;">+12.5%</span> -->
      </div>
      <p
        style="font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin:0 0 6px;">
        Total Pendapatan</p>
      <p style="font-size:26px; font-weight:900; color:#1f2937; margin:0;">
        Rp{{ number_format($stats['pendapatan_bulan'], 0, ',', '.') }}</p>
    </div>

    {{-- Active Orders --}}
    <div
      style="background:white; border-radius:16px; padding:24px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
      <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
        <div
          style="width:44px; height:44px; background:#fffbeb; border-radius:12px; display:flex; align-items:center; justify-content:center;">
          <span class="material-symbols-outlined" style="color:#f59e0b; font-size:22px;">shopping_basket</span>
        </div>
        <!-- <span
            style="background:#eff6ff; color:#3b82f6; font-size:11px; font-weight:800; padding:4px 10px; border-radius:20px;">Today:
            {{ $stats['pesanan_hari_ini'] }}</span> -->
      </div>
      <p
        style="font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin:0 0 6px;">
        Total Pesanan Masuk</p>
      <p style="font-size:26px; font-weight:900; color:#1f2937; margin:0;">{{ $stats['total_pesanan'] }}</p>
    </div>

    {{-- Total Produk --}}
    <div
      style="background:white; border-radius:16px; padding:24px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
      <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px;">
        <div
          style="width:44px; height:44px; background:#f0fdf4; border-radius:12px; display:flex; align-items:center; justify-content:center;">
          <span class="material-symbols-outlined" style="color:#16a34a; font-size:22px;">inventory_2</span>
        </div>
        @if($stats['stok_menipis'] > 0)
          <span
            style="background:#fef2f2; color:#ef4444; font-size:11px; font-weight:800; padding:4px 10px; border-radius:20px;">{{ $stats['stok_menipis'] }}
            Menipis!</span>
        @else
          <!-- <span
                style="background:#f0fdf4; color:#16a34a; font-size:11px; font-weight:800; padding:4px 10px; border-radius:20px;">New</span> -->
        @endif
      </div>
      <p
        style="font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin:0 0 6px;">
        Total Produk</p>
      <p style="font-size:26px; font-weight:900; color:#1f2937; margin:0;">{{ $stats['total_produk'] }}</p>
    </div>
  </div>

  {{-- CHART + SPOTLIGHT ROW --}}
  <div style="display:grid; grid-template-columns:1fr 320px; gap:20px; margin-bottom:24px;">

    {{-- Sales Trends Chart --}}
    <div
      style="background:white; border-radius:16px; padding:28px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <div>
          <h2 style="font-size:18px; font-weight:800; color:#1f2937; margin:0 0 4px;">Grafik Pendapatan</h2>
          <!-- <p style="font-size:13px; color:#9ca3af; margin:0;">Revenue performance across this week</p> -->
        </div>
        <select onchange="window.location.href = '{{ route('admin.dashboard') }}?periode=' + this.value"
          style="border:1px solid #e5e7eb; border-radius:8px; font-size:12px; padding:6px 12px; color:#6b7280; font-weight:700; background:white; cursor:pointer;">
          <option value="7" {{ $periode_aktif === 7 ? 'selected' : '' }}>7 hari terakhir</option>
          <option value="30" {{ $periode_aktif === 30 ? 'selected' : '' }}>30 hari terakhir</option>
        </select>
      </div>

      @php
        $maxPesanan = $tren->max('pesanan') ?: 1;
      @endphp

      <div style="display:flex; align-items:flex-end; gap:10px; height:180px; padding-bottom:8px;">
        @foreach($tren as $index => $data)
          @php
            $persen = $maxPesanan > 0 ? ($data['pesanan'] / $maxPesanan) * 100 : 0;
            $persen = max($persen, 3);
            $isToday = $data['is_today'] ?? false;
            $warna = $isToday ? '#FF5C00' : '#FFE4D6';
          @endphp
          <div
            style="flex:1; display:flex; flex-direction:column; align-items:center; gap:6px; height:100%; position:relative;">
            {{-- Tooltip hari ini --}}
            @if($isToday && $data['pesanan'] > 0)
              <div
                style="position:absolute; top:-36px; left:50%; transform:translateX(-50%); background:#1f2937; color:white; font-size:11px; font-weight:800; padding:5px 10px; border-radius:8px; white-space:nowrap; z-index:10;">
                Today: {{ $data['pesanan'] }} pesanan
                <div
                  style="position:absolute; bottom:-5px; left:50%; transform:translateX(-50%); width:0; height:0; border-left:5px solid transparent; border-right:5px solid transparent; border-top:5px solid #1f2937;">
                </div>
              </div>
            @endif

            {{-- Bar --}}
            <div style="flex:1; display:flex; flex-direction:column; justify-content:flex-end; width:100%;">
              <div
                style="width:100%; height:{{ $persen }}%; background:{{ $warna }}; border-radius:8px 8px 0 0; transition:all 0.3s; cursor:pointer;"
                onmouseover="this.style.background='#FF5C00'; this.style.opacity='0.9'"
                onmouseout="this.style.background='{{ $warna }}'; this.style.opacity='1'"
                title="{{ $data['tanggal'] }}: {{ $data['pesanan'] }} pesanan">
              </div>
            </div>

            {{-- Label --}}
            <div style="text-align:center;">
              <div
                style="font-size:11px; font-weight:800; color:{{ $isToday ? '#FF5C00' : '#9ca3af' }}; text-transform:uppercase;">
                {{ strtoupper($data['label']) }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Menu Spotlight --}}
    <div
      style="background:linear-gradient(135deg, #FF5C00, #a73a00); border-radius:16px; padding:28px; color:white; position:relative; overflow:hidden; display:flex; flex-direction:column; justify-content:space-between;">
      <div style="position:absolute; right:-20px; bottom:-20px; opacity:0.1;">
        <span class="material-symbols-outlined" style="font-size:160px;">local_fire_department</span>
      </div>
      <div>
        <h2 style="font-size:18px; font-weight:800; margin:0 0 8px;">Menu Unggulan🔥</h2>
        <p style="font-size:13px; opacity:0.85; margin:0 0 20px; line-height:1.5;">"Tahu Gejrot Super Racing" naik 40%
          pesanan hari ini.</p>

        {{-- Best Seller --}}
        @php
          $bestSeller = \App\Models\Produk::withCount('detailPesanans')->orderByDesc('detail_pesanans_count')->first();
        @endphp
        @if($bestSeller)
          <div
            style="background:rgba(255,255,255,0.15); border-radius:12px; padding:14px; display:flex; align-items:center; gap:12px; border:1px solid rgba(255,255,255,0.2);">
            <div
              style="width:52px; height:52px; border-radius:10px; background:rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; flex-shrink:0; overflow:hidden;">
              @if($bestSeller->gambar)
                <img src="{{ Storage::url($bestSeller->gambar) }}" style="width:100%; height:100%; object-fit:cover;">
              @else
                <span style="font-size:24px;">🧀</span>
              @endif
            </div>
            <div>
              <p style="font-weight:800; font-size:14px; margin:0 0 2px;">{{ $bestSeller->nama }}</p>
              <p style="font-size:11px; opacity:0.75; margin:0;">Best Seller Bulan Ini</p>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  {{-- RECENT ORDERS --}}
  <div
    style="background:white; border-radius:16px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04); overflow:hidden; margin-bottom:24px;">
    <div
      style="padding:24px 28px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
      <h2 style="font-size:18px; font-weight:800; color:#1f2937; margin:0;">Pesanan Terbaru</h2>
      <div style="display:flex; gap:10px; align-items:center;">
        <div style="position:relative;">
          <span class="material-symbols-outlined"
            style="position:absolute; left:10px; top:50%; transform:translateY(-50%); font-size:16px; color:#9ca3af;">search</span>
          <input placeholder="Cari pesanan..."
            style="padding:8px 12px 8px 34px; border:1px solid #e5e7eb; border-radius:10px; font-size:13px; width:200px; outline:none; font-family:inherit;">
        </div>
        <button
          style="width:36px; height:36px; background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
          <span class="material-symbols-outlined" style="font-size:18px; color:#6b7280;">filter_list</span>
        </button>
      </div>
    </div>

    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="background:#f9fafb;">
          <th
            style="padding:12px 28px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">
            Order ID</th>
          <th
            style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">
            Customer</th>
          <th
            style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">
            Date</th>
          <th
            style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">
            Amount</th>
          <th
            style="padding:12px 16px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">
            Status</th>
          <th
            style="padding:12px 28px; text-align:left; font-size:11px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:1px;">
            Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pesananTerbaru as $pesanan)
          @php
            $statusStyle = [
              'menunggu' => ['#fff7ed', '#FF5C00', 'Pending'],
              'dikonfirmasi' => ['#fffbeb', '#f59e0b', 'Confirmed'],
              'diproses' => ['#eff6ff', '#3b82f6', 'Processing'],
              'dikirim' => ['#f5f3ff', '#8b5cf6', 'Shipped'],
              'selesai' => ['#f0fdf4', '#16a34a', 'Delivered'],
              'dibatalkan' => ['#fef2f2', '#ef4444', 'Cancelled'],
            ][$pesanan->status] ?? ['#f9fafb', '#6b7280', ucfirst($pesanan->status)];
          @endphp
          <tr style="border-top:1px solid #f3f4f6; transition:background 0.15s;"
            onmouseover="this.style.background='#fffbf7'" onmouseout="this.style.background='white'">
            <td style="padding:16px 28px; font-weight:800; font-size:13px; color:#1f2937;">#{{ $pesanan->kode_pesanan }}
            </td>
            <td style="padding:16px;">
              <div style="display:flex; align-items:center; gap:10px;">
                <div
                  style="width:32px; height:32px; border-radius:50%; background:#FFE4D6; color:#FF5C00; font-weight:800; font-size:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                  {{ strtoupper(substr($pesanan->user->name, 0, 1)) }}
                </div>
                <span style="font-size:13px; font-weight:600; color:#1f2937;">{{ $pesanan->user->name }}</span>
              </div>
            </td>
            <td style="padding:16px; font-size:13px; color:#6b7280;">{{ $pesanan->created_at->format('M d, H:i') }}</td>
            <td style="padding:16px; font-size:13px; font-weight:800; color:#1f2937;">
              Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
            <td style="padding:16px;">
              <span
                style="background:{{ $statusStyle[0] }}; color:{{ $statusStyle[1] }}; font-size:11px; font-weight:800; padding:5px 12px; border-radius:20px;">
                {{ $statusStyle[2] }}
              </span>
            </td>
            <td style="padding:16px 28px;">
              <a href="{{ route('admin.pesanan.show', $pesanan->id) }}"
                style="color:#FF5C00; font-weight:800; font-size:13px; text-decoration:none;"
                onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                Details
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="padding:48px; text-align:center; color:#9ca3af;">
              <div style="font-size:48px; margin-bottom:12px;">📭</div>
              <p style="font-weight:700;">Belum ada pesanan</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div style="padding:16px 28px; border-top:1px solid #f3f4f6; text-align:center;">
      <a href="{{ route('admin.pesanan.index') }}"
        style="color:#FF5C00; font-weight:800; font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:6px;"
        onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
        Lihat Semua Pesanan
        <span class="material-symbols-outlined" style="font-size:16px;">arrow_forward</span>
      </a>
    </div>
  </div>

  {{-- BOTTOM ROW --}}
  <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px;">

    {{-- Stok Menipis --}}
    <div
      style="background:white; border-radius:16px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04); overflow:hidden;">
      <div style="padding:20px 24px; border-bottom:1px solid #f3f4f6;">
        <h3
          style="font-size:14px; font-weight:800; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin:0 0 20px;">
          Peringatan</h3>
      </div>
      <div>
        @forelse($produkStokSedikit as $p)
          <div
            style="padding:12px 24px; border-bottom:1px solid #f9fafb; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:13px; color:#1f2937; font-weight:600;">{{ $p->nama }}</span>
            <span
              style="background:#fef2f2; color:#ef4444; font-size:11px; font-weight:800; padding:3px 10px; border-radius:20px;">{{ $p->stok }}
              {{ $p->satuan }}</span>
          </div>
        @empty
          <div style="padding:24px; text-align:center; color:#9ca3af; font-size:13px; font-weight:600;">
            ✅ Semua stok aman!
          </div>
        @endforelse
      </div>
    </div>

    {{-- Quick Stats --}}
    <div
      style="background:white; border-radius:16px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04); padding:24px;">
      <h3
        style="font-size:14px; font-weight:800; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin:0 0 20px;">
        Statistik Cepat</h3>
      <div style="display:flex; flex-direction:column; gap:16px;">
        <div
          style="display:flex; justify-content:space-between; align-items:center; padding-bottom:16px; border-bottom:1px solid #f3f4f6;">
          <span style="font-size:13px; color:#6b7280; font-weight:600;">Total Customer</span>
          <span style="font-size:18px; font-weight:900; color:#1f2937;">{{ $stats['total_customer'] }}</span>
        </div>
        <div
          style="display:flex; justify-content:space-between; align-items:center; padding-bottom:16px; border-bottom:1px solid #f3f4f6;">
          <span style="font-size:13px; color:#6b7280; font-weight:600;">Pesanan Hari Ini</span>
          <span style="font-size:18px; font-weight:900; color:#FF5C00;">{{ $stats['pesanan_hari_ini'] }}</span>
        </div>
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <span style="font-size:13px; color:#6b7280; font-weight:600;">Produk Aktif</span>
          <span style="font-size:18px; font-weight:900; color:#1f2937;">{{ $stats['total_produk'] }}</span>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div
      style="background:white; border-radius:16px; border:1px solid #f3f4f6; box-shadow:0 2px 8px rgba(0,0,0,0.04); padding:24px;">
      <h3
        style="font-size:14px; font-weight:800; color:#9ca3af; text-transform:uppercase; letter-spacing:1px; margin:0 0 20px;">
        Aksi Cepat</h3>
      <div style="display:flex; flex-direction:column; gap:10px;">
        <a href="{{ route('admin.produk.create') }}"
          style="display:flex; align-items:center; gap:12px; padding:12px; background:#f9fafb; border-radius:12px; text-decoration:none; font-size:13px; font-weight:700; color:#1f2937; transition:all 0.15s;"
          onmouseover="this.style.background='#fff7ed'; this.style.color='#FF5C00'"
          onmouseout="this.style.background='#f9fafb'; this.style.color='#1f2937'">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">add_box</span> Tambah Produk Baru
        </a>
        <a href="{{ route('admin.pesanan.index', ['status' => 'menunggu']) }}"
          style="display:flex; align-items:center; gap:12px; padding:12px; background:#f9fafb; border-radius:12px; text-decoration:none; font-size:13px; font-weight:700; color:#1f2937; transition:all 0.15s;"
          onmouseover="this.style.background='#fff7ed'; this.style.color='#FF5C00'"
          onmouseout="this.style.background='#f9fafb'; this.style.color='#1f2937'">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">pending_actions</span> Pesanan
          Menunggu
        </a>
        <a href="{{ route('admin.pesanan.index', ['status' => 'menunggu']) }}"
          style="display:flex; align-items:center; gap:12px; padding:12px; background:#f9fafb; border-radius:12px; text-decoration:none; font-size:13px; font-weight:700; color:#1f2937; transition:all 0.15s;"
          onmouseover="this.style.background='#fff7ed'; this.style.color='#FF5C00'"
          onmouseout="this.style.background='#f9fafb'; this.style.color='#1f2937'">
          <span class="material-symbols-outlined" style="font-size:18px; color:#FF5C00;">payments</span> Konfirmasi Bayar
        </a>
      </div>
    </div>
  </div>

@endsection