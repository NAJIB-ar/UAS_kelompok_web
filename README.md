# Dokumentasi Proyek: Academic Seminar (Event Ticketing System)

Aplikasi ini adalah platform direktori dan pemesanan tiket seminar akademik yang memungkinkan pengguna mencari seminar, membeli tiket, serta memfasilitasi admin untuk mengelola acara dan memverifikasi pembayaran.

---

## 1. Bahasa Pemrograman yang Digunakan

- **PHP**: Sebagai bahasa pemrograman utama di sisi _server_ (Backend).
- **JavaScript**: Digunakan untuk interaktivitas di sisi klien.
- **HTML5 & CSS3**: Untuk markup dan styling struktur antarmuka pengguna.

## 2. Framework dan Library

- **Laravel**: Framework PHP utama yang menangani _Routing_, _Controller_, _Database ORM (Eloquent)_, dan _Authentication_.
- **Tailwind CSS**: Framework CSS _utility-first_ untuk mendesain antarmuka secara responsif, cepat, dan modern.
- **Alpine.js**: Library JavaScript ringan (terbawa dari ekosistem Laravel Breeze) untuk menangani _state_ interaktif sederhana seperti _dropdown_ menu navigasi.
- **Vite**: _Build tool_ (bundler) yang digunakan untuk mengkompilasi _asset_ CSS dan JavaScript.

## 3. Routes dan API

- **Internal Routes (`routes/web.php`)**:

    **Rute Publik & Autentikasi**
    - `GET /` : Secara otomatis mengarahkan pengunjung (redirect) ke halaman login.
    - _Rute Auth bawaan Laravel_ : Mengelola pendaftaran (`/register`), masuk (`/login`), dan keluar (`/logout`).

    **Rute Partisipan / Pengguna (Akses Terbatas: `auth`, `verified`)**
    - `GET /dashboard` : Menampilkan halaman katalog
    - `GET /event/{id}` : Menampilkan halaman rincian seminar
    - `POST /event/{id}/book` : _Endpoint_ untuk memproses unggahan bukti bayar dan registrasi seminar.
    - `GET /my-tickets` : Menampilkan halaman "Tiket Saya"
    - `GET, PATCH, DELETE /profile` : _Endpoint_ pengelolaan profil pengguna.

    **Rute Admin (Akses Terbatas: `auth`, `admin`)**
    - `GET /admin/dashboard` : Halaman utama untuk administrator.
    - `POST /admin/booking/{id}/approve` : _Endpoint_ verifikasi bukti bayar pengguna.
    - `POST /admin/booking/{id}/reject` : _Endpoint_ menolak bukti bayar pengguna.
    - `Rute Resource /admin/events` : Menyediakan seperangkat _endpoint_ CRUD seminar/acara.

- **External API (Third-party)**: Menggunakan layanan API pihak ketiga, yaitu **goqr.me** (`https://api.qrserver.com/v1/create-qr-code/`) untuk merender gambar QR Code secara langsung (on-the-fly) berdasarkan kode registrasi tiket.

## 4. Database yang Digunakan

Sistem menggunakan Relational Database Management System (RDBMS) yang terintegrasi penuh melalui Laravel Eloquent.

Struktur tabel:

### Tabel `users`

| Kolom               | Tipe Data             |
| :------------------ | :-------------------- |
| `id`                | bigint (Primary Key)  |
| `name`              | varchar               |
| `email`             | varchar (Unique)      |
| `email_verified_at` | timestamp (Nullable)  |
| `password`          | varchar               |
| `role`              | enum('user', 'admin') |
| `remember_token`    | varchar               |
| `timestamps`        | timestamp             |

### Tabel `events`

| Kolom             | Tipe Data                 |
| :---------------- | :------------------------ |
| `id`              | bigint (Primary Key)      |
| `title`           | varchar                   |
| `speaker`         | varchar                   |
| `category`        | varchar                   |
| `type`            | enum('online', 'offline') |
| `description`     | text                      |
| `location`        | varchar                   |
| `event_date`      | datetime                  |
| `price`           | integer                   |
| `ticket_quantity` | integer                   |
| `image`           | varchar (Nullable)        |
| `timestamps`      | timestamp                 |

### Tabel `bookings`

| Kolom                | Tipe Data                               |
| :------------------- | :-------------------------------------- |
| `id`                 | bigint (Primary Key)                    |
| `user_id`            | bigint (Foreign Key)                    |
| `event_id`           | bigint (Foreign Key)                    |
| `ticket_code`        | varchar (Unique)                        |
| `quantity_purchased` | integer                                 |
| `total_price`        | integer                                 |
| `payment_proof`      | varchar (Nullable)                      |
| `status`             | enum('pending', 'approved', 'rejected') |
| `timestamps`         | timestamp                               |

## 5. Proses Instalasi Awal

Menjalankan proyek di _environment_ lokal:

```bash
# 1. Clone repository
# 2. Instalasi dependensi PHP
composer install

# 3. Instalasi dependensi NPM
npm install

# 4. Salin pengaturan environment
cp .env.example .env

# 5. Generate Application Key
php artisan key:generate

# 6. Konfigurasi database di file .env (sesuaikan DB_DATABASE, DB_USERNAME, dll)

# 7. Jalankan Migrasi dan Seeder
php artisan migrate --seed

# 8. Buat symlink untuk mengakses folder storage (Wajib untuk gambar poster!)
php artisan storage:link

# 9. Build aset frontend (Tailwind)
npm run build

# 10. Jalankan local server
php artisan serve
```

## 6. Fungsi dan Fitur Proyek

- **Manajemen Autentikasi & Role**: Registrasi dan Login dengan pemisahan akses yang jelas antara _Admin_ dan _User_ biasa.
- **Katalog Seminar (Dashboard User)**: Pengguna dapat melihat daftar seminar/event yang tersedia beserta detail, kuota, pembicara, waktu, dan harga (atau Gratis).
- **Booking Tiket**: Fitur bagi pengguna untuk mendaftar seminar dan mengunggah (upload) bukti pembayaran.
- **Tiket Saya**: Halaman riwayat pembelian tiket milik _User_ yang menampilkan status pembayaran (Menunggu, Terverifikasi, Ditolak) beserta **QR Code** untuk registrasi/check-in.
- **Panel Admin**:
    - CRUD Seminar: Tambah, edit, hapus, dan perbarui poster acara.
    - Verifikasi Transaksi: Admin dapat melihat bukti pembayaran dari pengguna dan mengubah status tiket menjadi "Terverifikasi" atau "Ditolak".

## 7. Kelebihan Proyek

- **Aman (Secure)**: Menggunakan fitur bawaan Laravel (seperti CSRF protection, Prepared Statements untuk SQL Injection, dan sistem validasi input yang ketat).
- **QR Code Dinamis**: Penggunaan QR code pada tiket sangat mempermudah proses identifikasi pengguna di kemudian hari.
- **Manajemen File Terpusat**: Gambar (poster/bukti bayar) diorganisir rapi di dalam `storage` sehingga tidak membebani _public root_.

## 8. Kekurangan Proyek (Saran Pengembangan)

- **Pembayaran Masih Manual**: Sistem _booking_ masih mengharuskan user mengunggah bukti bayar yang harus divalidasi secara manual oleh Admin. Akan jauh lebih efisien bila diintegrasikan dengan Payment Gateway otomatis (seperti Midtrans, Xendit, atau Stripe).
- **Ketiadaan Sistem _Scanner_**: Walaupun tiket memiliki QR Code, belum ada halaman khusus atau fitur _scanner_ (memanfaatkan kamera perangkat) untuk Admin memindai dan memverifikasi QR Code saat acara berlangsung
