# Sistem Pemesanan Tiket Pendakian

Sistem ini adalah aplikasi berbasis web untuk mengelola pemesanan tiket pendakian gunung. Dibangun menggunakan framework Laravel, sistem ini mencakup fitur untuk admin (manajemen pendaki, verifikasi pembayaran, laporan) dan pengguna (pemesanan tiket, riwayat transaksi).

## Struktur Proyek

- `app/`: Logika inti aplikasi (Controllers, Models, Middleware).
- `resources/views/`: File template UI (Blade).
- `routes/`: Definisi rute aplikasi.
- `docs/`: Dokumentasi teknis dan catatan pengembangan.
- `database/`: Migrasi dan seeder database.

## Dokumentasi Teknis

Untuk informasi lebih lanjut mengenai implementasi teknis, silakan lihat folder `docs/`:
- [Dokumentasi Panel Admin](docs/ADMIN_PANEL_DOCUMENTATION.md)
- [Proses Verifikasi Pembayaran](docs/PAYMENT_VERIFICATION_README.md)
- [Dokumentasi Login](docs/LOGIN_DOCUMENTATION.md)
- [Ringkasan Implementasi](docs/IMPLEMENTATION_SUMMARY.md)

## Cara Instalasi

1. Clone repository ini.
2. Jalankan `composer install`.
3. Jalankan `npm install && npm run dev`.
4. Salin `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
5. Jalankan `php artisan key:generate`.
6. Jalankan `php artisan migrate --seed`.
7. Jalankan `php artisan serve`.

---
*Proyek ini dikembangkan sebagai bagian dari tugas akademik.*
