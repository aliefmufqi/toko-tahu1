<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Admin TahuBalap - @yield('title', 'Dashboard')</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
      colors: { primary: '#FF5C00', 'primary-dark': '#a73a00' }
    }
  }
}
</script>
<style>
.material-symbols-outlined {
  font-family: 'Material Symbols Outlined';
  font-weight: normal;
  font-style: normal;
  font-size: 20px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
}
.sidebar-link {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 16px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 600;
  color: #6b7280;
  transition: all 0.15s;
  margin: 2px 8px;
  text-decoration: none;
}
.sidebar-link:hover { background: #fff7ed; color: #FF5C00; }
.sidebar-link.active {
  background: #fff7ed;
  color: #FF5C00;
  border-right: 3px solid #FF5C00;
  border-radius: 10px 0 0 10px;
}
</style>
@stack('styles')
</head>
<body style="background:#f9fafb; font-family:'Plus Jakarta Sans',sans-serif;">

<div style="display:flex; min-height:100vh;">

  {{-- ===== SIDEBAR ===== --}}
  <aside style="width:256px; background:white; border-right:1px solid #f3f4f6; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:2px 0 8px rgba(0,0,0,0.04); z-index:50;">

    {{-- Brand --}}
    <div style="padding:24px 20px; border-bottom:1px solid #f3f4f6;">
      <div style="font-size:20px; font-weight:900; color:#FF5C00; font-style:italic; letter-spacing:-1px;">TahuBalap</div>
      <div style="font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase; letter-spacing:2px; margin-top:2px;">Admin Panel</div>
    </div>

    {{-- Nav --}}
    <nav style="flex:1; padding:16px 0; overflow-y:auto;">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="material-symbols-outlined">dashboard</span> Dashboard
      </a>
      <a href="{{ route('admin.produk.index') }}" class="sidebar-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined">inventory_2</span> Produk
      </a>
      <a href="{{ route('admin.kategori.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined">category</span> Kategori
      </a>
      <a href="{{ route('admin.resep.index') }}" class="sidebar-link {{ request()->routeIs('admin.resep.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined">menu_book</span> Resep
      </a>
      <a href="{{ route('admin.pesanan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined">shopping_basket</span> Pesanan
      </a>
      <a href="{{ route('admin.user.index') }}" class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined">group</span> Pengguna
      </a>
      <a href="{{ route('admin.setting.index') }}" class="sidebar-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined">settings</span> Pengaturan
      </a>

      <div style="margin:16px 20px 8px; font-size:10px; font-weight:800; color:#d1d5db; text-transform:uppercase; letter-spacing:2px;">Lainnya</div>
      <a href="{{ route('home') }}" class="sidebar-link">
        <span class="material-symbols-outlined">open_in_new</span> Lihat Toko
      </a>
    </nav>

    {{-- User --}}
    <div style="padding:16px; border-top:1px solid #f3f4f6;">
      <div style="display:flex; align-items:center; gap:12px; padding:8px; margin-bottom:8px;">
        <div style="width:40px; height:40px; border-radius:50%; background:#FF5C00; color:white; font-weight:900; font-size:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div style="overflow:hidden;">
          <div style="font-size:13px; font-weight:700; color:#1f2937; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
          <div style="font-size:10px; color:#9ca3af; text-transform:uppercase; font-weight:600;">Super Admin</div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button style="width:100%; display:flex; align-items:center; gap:8px; padding:8px 12px; font-size:13px; font-weight:700; color:#ef4444; background:none; border:none; border-radius:8px; cursor:pointer;"
          onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='none'">
          <span class="material-symbols-outlined" style="font-size:18px;">logout</span> Keluar
        </button>
      </form>
    </div>
  </aside>

  {{-- ===== MAIN CONTENT ===== --}}
  <main style="flex:1; margin-left:256px; min-height:100vh; padding:40px;">

    {{-- ===== HEADER ===== --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">

      {{-- Judul --}}
      <div>
        <h1 style="font-size:28px; font-weight:900; color:#1f2937; margin:0 0 4px;">@yield('title', 'Dashboard')</h1>
        <p style="font-size:14px; color:#6b7280; margin:0;">@yield('subtitle', 'Selamat datang di panel admin TahuBalap')</p>
      </div>

      {{-- Kanan: Tombol Aksi + Notifikasi + Nama --}}
      <div style="display:flex; align-items:center; gap:12px;">

        {{-- *** TOMBOL AKSI HALAMAN (Tambah Produk, dll) *** --}}
        @yield('header-actions')

        {{-- Bell Notifikasi --}}
        <div style="position:relative;" id="notif-wrapper">
          <button onclick="toggleNotif()"
            style="position:relative; width:42px; height:42px; background:white; border:1px solid #f3f4f6; border-radius:12px; cursor:pointer; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(0,0,0,0.06);">
            <span class="material-symbols-outlined" style="font-size:20px; color:#6b7280;">notifications</span>
            <span id="notif-badge"
              style="display:none; position:absolute; top:-6px; right:-6px; background:#FF5C00; color:white; font-size:10px; font-weight:800; width:20px; height:20px; border-radius:50%; align-items:center; justify-content:center; border:2px solid white;">
              0
            </span>
          </button>

          {{-- Dropdown Notifikasi --}}
          <div id="notif-dropdown"
            style="display:none; position:absolute; right:0; top:52px; width:360px; background:white; border-radius:16px; border:1px solid #f3f4f6; box-shadow:0 20px 40px rgba(0,0,0,0.12); z-index:999; overflow:hidden;">
            <div style="padding:16px 20px; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
              <div>
                <p style="font-size:15px; font-weight:800; color:#1f2937; margin:0;">Notifikasi</p>
                <p id="notif-count-text" style="font-size:12px; color:#9ca3af; margin:0;">Memuat...</p>
              </div>
              <div style="display:flex; gap:8px;">
                <button onclick="tandaiBacaSemua()"
                  style="font-size:11px; font-weight:700; color:#FF5C00; background:none; border:none; cursor:pointer; padding:4px 8px; border-radius:6px;"
                  onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='none'">
                  Tandai Dibaca
                </button>
                <button onclick="hapusSemua()"
                  style="font-size:11px; font-weight:700; color:#ef4444; background:none; border:none; cursor:pointer; padding:4px 8px; border-radius:6px;"
                  onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='none'">
                  Hapus Semua
                </button>
              </div>
            </div>
            <div id="notif-list" style="max-height:380px; overflow-y:auto;">
              <div style="padding:32px; text-align:center; color:#9ca3af;">
                <span class="material-symbols-outlined" style="font-size:40px; display:block; margin-bottom:8px;">notifications_none</span>
                <p style="font-size:13px; font-weight:600; margin:0;">Belum ada notifikasi</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Nama Admin --}}
        <div style="font-size:14px; color:#6b7280; font-weight:600;">{{ auth()->user()->name }}</div>
      </div>
    </div>

    {{-- Flash sukses --}}
    @if(session('sukses'))
    <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534; border-radius:12px; padding:14px 20px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; font-weight:700; font-size:14px;">
      <span style="display:flex; align-items:center; gap:8px;">
        <span class="material-symbols-outlined" style="font-size:18px;">check_circle</span>
        {{ session('sukses') }}
      </span>
      <button onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#166534;">
        <span class="material-symbols-outlined" style="font-size:18px;">close</span>
      </button>
    </div>
    @endif

    {{-- Flash error --}}
    @if(session('error'))
    <div style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; border-radius:12px; padding:14px 20px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; font-weight:700; font-size:14px;">
      <span style="display:flex; align-items:center; gap:8px;">
        <span class="material-symbols-outlined" style="font-size:18px;">error</span>
        {{ session('error') }}
      </span>
      <button onclick="this.parentElement.remove()" style="background:none; border:none; cursor:pointer; color:#991b1b;">
        <span class="material-symbols-outlined" style="font-size:18px;">close</span>
      </button>
    </div>
    @endif

    {{-- ===== KONTEN HALAMAN ===== --}}
    @yield('content')

  </main>
</div>

{{-- ===== SCRIPT NOTIFIKASI ===== --}}
<script>
function toggleNotif() {
  const dd = document.getElementById('notif-dropdown');
  dd.style.display = dd.style.display === 'none' ? 'block' : 'none';
  if (dd.style.display === 'block') loadNotif();
}

document.addEventListener('click', function(e) {
  const wrapper = document.getElementById('notif-wrapper');
  if (wrapper && !wrapper.contains(e.target)) {
    document.getElementById('notif-dropdown').style.display = 'none';
  }
});

function loadNotif() {
  fetch('{{ route("admin.notifikasi.index") }}')
    .then(r => r.json())
    .then(data => {
      const badge = document.getElementById('notif-badge');
      const list  = document.getElementById('notif-list');
      const count = document.getElementById('notif-count-text');

      if (data.belum_dibaca > 0) {
        badge.style.display = 'flex';
        badge.textContent   = data.belum_dibaca > 99 ? '99+' : data.belum_dibaca;
        count.textContent   = data.belum_dibaca + ' belum dibaca';
      } else {
        badge.style.display = 'none';
        count.textContent   = 'Semua sudah dibaca';
      }

      if (data.notifikasis.length === 0) {
        list.innerHTML = `
          <div style="padding:32px; text-align:center; color:#9ca3af;">
            <span class="material-symbols-outlined" style="font-size:40px; display:block; margin-bottom:8px;">notifications_none</span>
            <p style="font-size:13px; font-weight:600; margin:0;">Belum ada notifikasi</p>
          </div>`;
        return;
      }

      list.innerHTML = data.notifikasis.map(n => `
        <div onclick="bukaNotif('${n.id}', '${n.data.url}')"
          style="padding:16px 20px; border-bottom:1px solid #f9fafb; cursor:pointer; background:${n.dibaca ? 'white' : '#fffbf7'}; transition:background 0.15s; display:flex; gap:12px; align-items:flex-start;"
          onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='${n.dibaca ? 'white' : '#fffbf7'}'">
          <div style="width:40px; height:40px; border-radius:12px; background:${n.dibaca ? '#f3f4f6' : '#FFE4D6'}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
            <span class="material-symbols-outlined" style="font-size:20px; color:${n.dibaca ? '#9ca3af' : '#FF5C00'};">shopping_basket</span>
          </div>
          <div style="flex:1; min-width:0;">
            <p style="font-size:13px; font-weight:${n.dibaca ? '600' : '800'}; color:#1f2937; margin:0 0 3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
              ${n.data.pesan}
            </p>
            <p style="font-size:12px; color:#6b7280; margin:0 0 3px;">
              Kode: <strong>${n.data.kode_pesanan}</strong> · Rp${Number(n.data.total).toLocaleString('id-ID')}
            </p>
            <p style="font-size:11px; color:#9ca3af; margin:0;">${n.waktu}</p>
          </div>
          ${!n.dibaca ? '<div style="width:8px; height:8px; background:#FF5C00; border-radius:50%; flex-shrink:0; margin-top:4px;"></div>' : ''}
        </div>
      `).join('');
    })
    .catch(err => console.log('Notif error:', err));
}

function bukaNotif(id, url) {
  fetch(`{{ url('admin/notifikasi/baca') }}/${id}`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
  }).then(() => window.location.href = url);
}

function tandaiBacaSemua() {
  fetch('{{ route("admin.notifikasi.baca") }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
  }).then(() => loadNotif());
}

function hapusSemua() {
  if (!confirm('Yakin hapus semua notifikasi?')) return;
  fetch('{{ route("admin.notifikasi.hapus") }}', {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
  }).then(() => loadNotif());
}

loadNotif();
setInterval(loadNotif, 15000);
</script>

@stack('scripts')
</body>
</html>