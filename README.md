# 📚 Sistem Informasi Perpustakaan (Proyek Akhir - Pertemuan 8)

Aplikasi web manajemen perpustakaan berbasis **Laravel 12 / 13** dan **Tailwind CSS** dengan sistem autentikasi admin (Laravel Breeze), manajemen data buku, data anggota, transaksi sirkulasi peminjaman/pengembalian, serta pencarian buku interaktif.

---

## 🌟 Fitur Utama Aplikasi

### A. Autentikasi Admin Sederhana (Laravel Breeze)
- Sistem login & registrasi admin menggunakan Laravel Breeze.
- Manajemen profil admin dan fitur logout yang aman.
- Seeder default untuk akun admin agar siap digunakan langsung.

### B. Proteksi Route dengan Middleware (`auth`)
- Seluruh endpoint pengelolaan data (`/buku`, `/anggota`, `/peminjaman`, `/dashboard`) dilindungi oleh middleware `auth`.
- Pengguna yang belum login otomatis dialihkan (*redirect*) ke halaman `/login`.

### C. Antarmuka Modern & Responsif (Tailwind CSS)
- **Navigasi Global (Navbar)**: Terintegrasi dengan menu **Dashboard**, **Data Buku**, **Data Anggota**, dan **Peminjaman**, dilengkapi menu mobile yang responsif.
- **Formulir & Tabel Elegan**: Mengadopsi styling Tailwind CSS dengan validasi input interaktif, status badge (indikator stok & status peminjaman), serta notifikasi alert.
- **Dashboard Ringkasan**: Menampilkan kartu metrik (Total Judul Buku, Total Stok, Total Anggota, Peminjaman Aktif) dan pintasan aksi cepat.

### D. Fitur Pencarian Data Buku
- Pencarian data buku berbasis kata kunci judul, pengarang, maupun kode buku.
- Dilengkapi tombol reset untuk mengembalikan daftar buku ke tampilan awal.

### E. Manajemen Sirkulasi Peminjaman
- Pencatatan peminjaman buku oleh anggota terdaftar.
- Otomatis mengurangi stok buku saat dipinjam dan menambah kembali stok saat buku dikembalikan (*return*).

---

## 🔐 Akun Default Admin

Setelah menjalankan seeder database, gunakan kredensial berikut untuk login:

- **URL Login**: `http://localhost:8000/login`
- **Email**: `admin@perpustakaan.com`
- **Password**: `password`

*(Anda juga dapat mendaftarkan akun admin baru melalui halaman `/register`)*

---

## 🚀 Panduan Menjalankan Aplikasi

### 1. Prasyarat Sistem
- PHP >= 8.2 (dilengkapi ekstensi pdo, pdo_mysql, mbstring, openssl)
- Composer
- Node.js & NPM
- MySQL Server (XAMPP / Laragon / MariaDB)

### 2. Konfigurasi Lingkungan (`.env`)
Pastikan database MySQL telah dibuat (contoh: `db_perpus`) dan konfigurasikan file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpus
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi & Seeder Database
Jalankan migrasi tabel dan buat akun admin default:

```bash
php artisan migrate
php artisan db:seed
```

### 4. Kompilasi Aset Frontend (Tailwind CSS)
```bash
npm install
npm run build
```
*Atau untuk pengembangan langsung dengan live reload:*
```bash
npm run dev
```

### 5. Menjalankan Server Aplikasi
```bash
php artisan serve
```

Akses aplikasi pada peramban web: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📂 Struktur Endpoint / Route Utama

| Metode | URL Route | Nama Route | Middleware | Deskripsi |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | - | - | Pengalihan otomatis ke Dashboard / Login |
| `GET` | `/login` | `login` | `guest` | Formulir login admin |
| `GET` | `/dashboard` | `dashboard` | `auth` | Dashboard statistik dan ringkasan |
| `GET` | `/buku` | `buku.index` | `auth` | Daftar buku & fitur pencarian |
| `GET` | `/buku/create` | `buku.create` | `auth` | Form tambah koleksi buku baru |
| `POST` | `/buku` | `buku.store` | `auth` | Simpan buku baru |
| `GET` | `/buku/{buku}/edit` | `buku.edit` | `auth` | Form edit informasi buku |
| `PUT` | `/buku/{buku}` | `buku.update` | `auth` | Update data buku |
| `DELETE` | `/buku/{buku}` | `buku.destroy` | `auth` | Hapus data buku |
| `GET` | `/anggota` | `anggota.index` | `auth` | Daftar anggota perpustakaan |
| `GET` | `/anggota/create` | `anggota.create` | `auth` | Form tambah anggota baru |
| `GET` | `/peminjaman` | `peminjaman.index` | `auth` | Daftar transaksi peminjaman |
| `GET` | `/peminjaman/create` | `peminjaman.create` | `auth` | Form transaksi baru |
| `PATCH` | `/peminjaman/{peminjaman}/kembalikan` | `peminjaman.kembalikan` | `auth` | Proses pengembalian buku |
