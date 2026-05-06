# CLAUDE.md — Toko Tahu

> File ini adalah panduan konteks project untuk Claude Code (AI assistant).
> Letakkan file ini di root project: `C:\laragon\www\toko-tahu\CLAUDE.md`
> Edit bagian yang bertanda `[EDIT]` sesuai kondisi aktual project kamu.

---

## 📌 Ringkasan Project

| Field               | Detail                                          |
| ------------------- | ----------------------------------------------- |
| **Nama Project**    | Toko Tahu                                       |
| **Deskripsi**       | Aplikasi e-commerce penjualan tahu berbasis web |
| **Tipe**            | Platform-based Web Application                  |
| **Framework**       | Laravel 10 (PHP 8.1+)                           |
| **Frontend**        | Bootstrap 5 + Blade Templating + Vite           |
| **Database**        | MySQL (via Laragon)                             |
| **Dev Environment** | Windows 11, Laragon, VS Code                    |
| **Status**          | [EDIT: Development / Staging / Production]      |
| **Versi**           | [EDIT: 1.0.0]                                   |

---

## 🧰 Tech Stack

```
Backend  : Laravel 10, PHP 8.1
Frontend : Bootstrap 5.2, Sass/SCSS, Vanilla JS
Bundler  : Vite 5
Auth     : Laravel UI (built-in)
Storage  : Local disk (public/storage)
DB ORM   : Eloquent ORM
```

### Package Utama (composer.json)

- `laravel/framework` ^10.10
- `laravel/ui` ^4.6 — Auth scaffolding
- `laravel/sanctum` ^3.3 — API token auth
- `intervention/image` ^3.11 — Upload & resize gambar produk
- `guzzlehttp/guzzle` ^7.2 — HTTP client

### Package Dev

- `laravel/breeze` — Auth starter kit (dev only)
- `laravel/sail` — Docker support (opsional)

---

## 📁 Struktur Folder Penting

```
toko-tahu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Controller khusus admin panel
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── AdminProdukController.php
│   │   │   │   ├── AdminPesananController.php
│   │   │   │   ├── AdminKategoriController.php
│   │   │   │   └── AdminUserController.php
│   │   │   ├── Auth/               # Controller auth bawaan Laravel UI
│   │   │   ├── HomeController.php
│   │   │   ├── ProdukController.php
│   │   │   ├── KeranjangController.php
│   │   │   └── PesananController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php  # Guard akses admin
│   └── Models/
│       ├── User.php
│       ├── Produk.php
│       ├── Kategori.php
│       ├── Pesanan.php
│       ├── DetailPesanan.php
│       └── Pembayaran.php
├── database/
│   ├── migrations/                 # Semua skema tabel
│   └── seeders/
│       └── DatabaseSeeder.php      # Data awal (admin, produk, kategori)
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php       # Layout utama customer
│   │   │   └── admin.blade.php     # Layout admin panel
│   │   ├── admin/                  # Semua view admin
│   │   ├── auth/                   # Login, register, reset password
│   │   ├── produk/
│   │   ├── pesanan/
│   │   ├── keranjang.blade.php
│   │   └── welcome.blade.php
│   ├── sass/
│   │   ├── app.scss                # Entry point CSS utama
│   │   └── _variables.scss         # Variabel warna/font Bootstrap
│   └── js/
│       └── app.js                  # Entry point JS utama
├── routes/
│   └── web.php                     # Semua route aplikasi
├── public/
│   └── build/                      # Output Vite (jangan diedit manual)
├── storage/
│   └── app/public/pembayaran/      # Upload bukti transfer
├── .env                            # Konfigurasi environment (JANGAN commit)
└── vite.config.js
```

---

## 🗄️ Database

**Nama Database:** `toko_tahu`
**Koneksi:** MySQL via Laragon (`127.0.0.1:3306`)
**User:** `root` | **Password:** _(kosong / sesuai setup Laragon)_

### Skema Tabel

| Tabel                    | Deskripsi                                                    |
| ------------------------ | ------------------------------------------------------------ |
| `users`                  | Data user (customer & admin), kolom tambahan: `role`         |
| `kategoris`              | Kategori produk tahu (nama, slug, deskripsi)                 |
| `produks`                | Data produk (nama, slug, harga, stok, gambar, satuan, aktif) |
| `pesanans`               | Header pesanan (kode_pesanan, total, status, alamat)         |
| `detail_pesanans`        | Item per pesanan (produk_id, qty, harga_satuan)              |
| `pembayarans`            | Bukti pembayaran (metode, jumlah, bukti_transfer, status)    |
| `password_resets`        | Token reset password                                         |
| `personal_access_tokens` | Token Sanctum API                                            |

### Relasi Antar Model

```
User          hasMany  Pesanan
Pesanan       hasMany  DetailPesanan
Pesanan       hasOne   Pembayaran
Produk        hasMany  DetailPesanan
Kategori      hasMany  Produk
DetailPesanan belongsTo Pesanan, Produk
Pembayaran    belongsTo Pesanan
```

### Status Pesanan

```
[EDIT — sesuaikan jika ada perubahan]
pending → dikonfirmasi → diproses → dikirim → selesai → dibatalkan
```

### Status Pembayaran

```
[EDIT]
menunggu → dikonfirmasi → ditolak
```

---

## 🔐 Autentikasi & Role

- Auth menggunakan **Laravel UI** (bukan Breeze/Jetstream)
- Dua role user: `admin` dan `customer`
- Guard admin: `AdminMiddleware` — cek via `auth()->user()->isAdmin()`
- Method `isAdmin()` ada di model `User.php`

**Akun Default (dari Seeder):**

| Role     | Email              | Password |
| -------- | ------------------ | -------- |
| Admin    | admin@tokotahu.com | admin123 |
| Customer | alief@email.com    | alief123 |

---

## 🛣️ Routes Utama

### Publik

```
GET  /                          → HomeController@index     (halaman utama)
GET  /produk                    → ProdukController@index   (daftar produk)
GET  /produk/{slug}             → ProdukController@show    (detail produk)
```

### Customer (auth required)

```
GET    /keranjang               → KeranjangController@index
POST   /keranjang/tambah        → KeranjangController@tambah
PATCH  /keranjang/{id}          → KeranjangController@update
DELETE /keranjang/{id}          → KeranjangController@hapus
GET    /checkout                → PesananController@checkout
POST   /pesanan                 → PesananController@store
GET    /pesanan                 → PesananController@index
GET    /pesanan/{kode}          → PesananController@show
POST   /pesanan/{kode}/bayar    → PesananController@bayar  (upload bukti)
```

### Admin (auth + role admin)

```
GET    /admin/dashboard
RESOURCE /admin/produk          → CRUD produk
RESOURCE /admin/kategori        → CRUD kategori
RESOURCE /admin/user            → CRUD user
GET    /admin/pesanan           → list semua pesanan
GET    /admin/pesanan/{id}      → detail pesanan
PATCH  /admin/pesanan/{id}/status          → update status pesanan
PATCH  /admin/pesanan/{id}/konfirmasi-bayar → konfirmasi pembayaran
```

---

## ⚙️ Environment & Konfigurasi

File `.env` yang perlu diperhatikan:

```env
APP_NAME=Laravel
APP_ENV=local           # [EDIT: production jika deploy]
APP_DEBUG=true          # [EDIT: false jika production]
APP_URL=http://localhost # [EDIT: sesuai URL development kamu]

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_tahu
DB_USERNAME=root
DB_PASSWORD=            # [EDIT: isi jika MySQL kamu pakai password]
```

> ⚠️ File `.env` **TIDAK BOLEH** di-commit ke Git. Sudah ada di `.gitignore`.

---

## 🖥️ Perintah Development

### Setup awal (sekali saja)

```bash
composer install
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
```

### Sehari-hari

```bash
# Jalankan server
php artisan serve

# Frontend (mode development dengan hot reload)
npm run dev

# Jika ada migration baru
php artisan migrate

# Reset database + seed ulang (HATI-HATI: hapus semua data)
php artisan migrate:fresh --seed

# Clear cache (jika ada perubahan config/route tidak terbaca)
php artisan optimize:clear
```

### Artisan lain yang berguna

```bash
php artisan route:list              # Lihat semua route
php artisan make:model NamaModel -m # Buat model + migration sekaligus
php artisan make:controller NamaController
php artisan tinker                  # REPL untuk test query Eloquent
```

---

## 🎨 Frontend & Styling

- CSS ditulis di `resources/sass/app.scss` (menggunakan Sass/SCSS)
- Variabel Bootstrap di-override di `resources/sass/_variables.scss`
- JavaScript di `resources/js/app.js`
- Setelah ubah file JS/CSS → jalankan `npm run build` (atau biarkan `npm run dev` aktif)
- Output build ada di `public/build/` — **jangan edit manual**

**[EDIT] Warna utama brand:**

```scss
// Di _variables.scss
$primary:   #[EDIT: hex warna utama];
$secondary: #[EDIT: hex warna sekunder];
```

---

## 🧩 Konvensi Kode

### Penamaan

- **Model:** PascalCase singular — `Produk`, `DetailPesanan`
- **Controller:** PascalCase + suffix Controller — `ProdukController`
- **Tabel DB:** snake_case plural — `detail_pesanans`, `produks`
- **Route name:** dot-notation — `produk.index`, `admin.pesanan.show`
- **Blade view:** snake_case, folder per fitur — `admin/produk/index.blade.php`
- **Variabel PHP:** camelCase — `$totalHarga`, `$kodePesanan`

### Aturan yang sudah ada di project ini

- Semua route admin wajib lewat middleware `auth` + `admin`
- Upload file (bukti transfer) disimpan di `storage/app/public/pembayaran/`
- Akses file upload via `Storage::url(...)` atau symlink `public/storage`
- Keranjang belanja disimpan di **session** (bukan database)

---

## ✅ Fitur yang Sudah Ada

- [x] Autentikasi (login, register, reset password)
- [x] Role admin & customer
- [x] CRUD produk (admin)
- [x] CRUD kategori (admin)
- [x] Manajemen user (admin)
- [x] Manajemen pesanan + update status (admin)
- [x] Konfirmasi pembayaran (admin)
- [x] Keranjang belanja (session-based)
- [x] Checkout & buat pesanan
- [x] Upload bukti transfer
- [x] Riwayat pesanan (customer)
- [x] Halaman detail pesanan

---

## 🚧 Fitur yang Belum Ada / TODO

<!-- > [EDIT: Isi dengan rencana fitur yang ingin ditambahkan]

- [ ] Pencarian produk
- [ ] Filter produk per kategori (frontend)
- [ ] Notifikasi email pesanan
- [ ] Integrasi payment gateway (Midtrans / Xendit)
- [ ] Export laporan penjualan (PDF/Excel)
- [ ] Rating & ulasan produk
- [ ] [EDIT: tambahkan fitur lainnya...] -->

---

## 🐛 Known Issues / Catatan

<!-- > [EDIT: Isi jika ada bug atau hal yang perlu diperhatikan]

- [ ] [EDIT: Contoh: Validasi stok saat checkout belum real-time]
- [ ] [EDIT: Contoh: Pagination produk admin belum diimplementasi] -->

- [ ubah teks "Rasakan Tahu Balap yang Cepat & Lezat" yang ada diberanda menjadi "ini adalah ujicoba"]

---

## 👤 Tim & Kontak

| Nama                      | Role                      | Kontak           |
| ------------------------- | ------------------------- | ---------------- |
| [EDIT: Nama Kamu]         | Full-stack Developer      | [EDIT: email/wa] |
| [EDIT: Nama Dosen/Client] | [EDIT: Supervisor/Client] | [EDIT: email]    |

---

## 📝 Catatan Tambahan untuk Claude

Ketika membantu project ini, perlu diketahui:

1. **Bahasa:** Kode menggunakan bahasa Indonesia untuk nama variabel domain (pesanan, keranjang, produk), tapi nama method/class mengikuti konvensi Laravel (English atau campuran).
2. **Keranjang:** Diimplementasi dengan `session()`, bukan tabel database tersendiri.
3. **Image upload:** Menggunakan package `intervention/image` untuk resize. Gambar produk disimpan di `storage/app/public/produk/` [EDIT: konfirmasi path ini].
4. **Middleware admin:** Custom class `AdminMiddleware`, didaftarkan di `app/Http/Kernel.php` dengan alias `admin`.
5. **Jangan ubah:** File di `public/build/`, file `.env`, dan file di `vendor/` / `node_modules/`.
6. [EDIT: Tambahkan konteks penting lainnya yang perlu diketahui Claude...]
