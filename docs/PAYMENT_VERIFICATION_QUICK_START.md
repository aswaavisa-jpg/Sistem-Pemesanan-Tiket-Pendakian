# 🚀 QUICK START - VERIFIKASI PEMBAYARAN

Panduan cepat menggunakan sistem verifikasi pembayaran.

---

## Untuk USER (Pendaki)

### Step 1: Buat Transaksi Baru
1. Go to: `http://localhost/penjualantiket`
2. Click tombol **"+ Tambah Transaksi"**
3. Pilih Pemesanan → Click **"Submit"**
4. Transaksi dibuat dengan status **"Pending"**

### Step 2: Upload Bukti Pembayaran
1. Di halaman list transaksi, klik **"Detail"**
2. Klik button **"Verifikasi Pembayaran"** (biru)
3. Pilih **Metode Pembayaran:**
   - **Transfer Bank** → Wajib upload bukti
   - **E-Wallet** → Wajib upload bukti
   - **Cash** → Tidak perlu upload bukti

### Step 3: Upload Bukti (untuk Transfer/E-wallet)
1. Bisa drag & drop atau klik untuk browse file
2. Pilih screenshot/foto bukti pembayaran
3. Format: JPG, PNG, JPEG (Max 2MB)
4. Preview akan muncul setelah dipilih

### Step 4: Submit Pembayaran
1. Tambah catatan (opsional) → Contoh: "Transfer sudah dilakukan"
2. Click **"Kirim Bukti Pembayaran"** (hijau)
3. Status berubah menjadi **"Pending"** (menunggu verifikasi admin)

### Step 5: Tunggu Verifikasi Admin
- **Terverifikasi:** Status berubah → "Verified" ✅
- **Ditolak:** Status berubah → "Rejected" ❌ → Bisa upload ulang

---

## Untuk ADMIN

### Step 1: Akses Admin Panel
1. Login dengan akun admin
2. Go to: `http://localhost/admin/pembayaran`

### Step 2: Lihat Daftar Pembayaran
- Default tampilkan semua pembayaran
- Gunakan filter untuk melihat status tertentu:
  - **Pending** → Belum diverifikasi
  - **Verified** → Sudah disetujui
  - **Rejected** → Ditolak

### Step 3: Periksa Detail Pembayaran
1. Klik button **"Lihat"** pada transaksi yang ingin diverifikasi
2. Lihat informasi transaksi lengkap
3. Klik **"Lihat Gambar"** untuk melihat bukti pembayaran

### Step 4: Verifikasi Pembayaran

#### Jika SETUJU:
1. Scroll ke section **"Setujui Pembayaran"** (hijau)
2. Tambah catatan verifikasi (opsional)
3. Click **"Verifikasi Pembayaran"**
4. Status berubah → "Verified" ✅

#### Jika TOLAK:
1. Scroll ke section **"Tolak Pembayaran"** (merah)
2. Isi alasan penolakan (wajib)
3. Click **"Tolak Pembayaran"**
4. Status berubah → "Rejected" ❌
5. User akan diminta upload ulang

---

## 💡 TIPS PENTING

### Untuk User:
- ✅ Pastikan gambar bukti **JELAS** dan **TERBACA**
- ✅ Sertakan **nomor referensi** di catatan
- ✅ Jangan close halaman sebelum submit berhasil
- ✅ Cek status secara berkala di halaman transaksi

### Untuk Admin:
- ✅ Verify pembayaran **SETIAP HARI** untuk customer service baik
- ✅ Reject dengan **ALASAN JELAS** agar user tahu kesalahannya
- ✅ Gunakan filter untuk fokus pada pembayaran pending
- ✅ Dokumentasi catatan verifikasi untuk audit trail

---

## 🔧 TROUBLESHOOTING

### Masalah: File upload tidak bisa
**Solusi:**
- Check format file (harus JPG/PNG/JPEG)
- Check file size (max 2MB)
- Refresh halaman jika timeout

### Masalah: Status tidak berubah setelah submit
**Solusi:**
- Refresh halaman / F5
- Check apakah admin sudah verify
- Lihat di admin panel `/admin/pembayaran`

### Masalah: Admin tidak bisa lihat gambar
**Solusi:**
- Pastikan storage link sudah jalan: `php artisan storage:link`
- Check folder permissions `storage/app/public/pembayaran`

---

## 📞 CONTACT SUPPORT

Jika ada pertanyaan atau error, hubungi admin system.

---

## 🎯 RINGKASAN BUTTON

| Halaman | Button | Fungsi |
|---------|--------|--------|
| Transaksi List | "Detail" | Lihat detail transaksi |
| Transaksi Detail | "Verifikasi Pembayaran" | Buka form upload bukti |
| Form Pembayaran | "Kirim Bukti Pembayaran" | Submit bukti ke admin |
| Admin Pembayaran | "Lihat" | Lihat detail untuk verifikasi |
| Admin Detail | "Verifikasi Pembayaran" | Approve pembayaran |
| Admin Detail | "Tolak Pembayaran" | Reject pembayaran |

---

**Last Updated:** 2026-01-14
