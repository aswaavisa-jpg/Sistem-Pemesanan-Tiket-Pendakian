# 📋 DOKUMENTASI SISTEM VERIFIKASI PEMBAYARAN

## Deskripsi Fitur

Sistem verifikasi pembayaran memungkinkan **user** untuk mengirimkan bukti pembayaran yang akan **diverifikasi oleh admin**. Proses ini mencakup:

1. **User mengirim bukti pembayaran** → Transfer bank, E-wallet, atau Cash
2. **Admin menerima dan memverifikasi** → Melihat bukti dan mengkonfirmasi
3. **Admin approve/reject** → Transaksi diterima atau ditolak untuk pengajuan ulang

---

## 🔧 KOMPONEN YANG DIBUAT

### 1. **Database Migration**
**File:** `database/migrations/2026_01_14_000001_add_payment_verification_to_penjualan_tiket.php`

Menambah kolom ke tabel `penjualan_tiket`:
- `status_pembayaran` → enum: 'pending', 'verified', 'rejected'
- `metode_pembayaran` → transfer, e-wallet, cash
- `bukti_pembayaran` → path ke file gambar
- `verified_by` → user ID admin yang verifikasi
- `verified_at` → waktu verifikasi
- `catatan_verifikasi` → catatan dari admin

### 2. **Model - Penjualantiket**
**File:** `app/Models/Penjualantiket.php`

**Update:**
- Tambah `fillable` fields untuk verifikasi
- Tambah `$casts` untuk datetime
- Tambah relationship `verifiedBy()` ke User model
- Tambah helper methods:
  - `isVerified()` → check status verified
  - `isPending()` → check status pending
  - `isRejected()` → check status rejected

### 3. **Form Request**
**File:** `app/Http/Requests/PaymentVerificationRequest.php`

**Validasi:**
- `metode_pembayaran` → required, in: transfer, e-wallet, cash
- `bukti_pembayaran` → required jika tidak cash, image, max 2MB
- `catatan_pembayaran` → optional, max 255 char

### 4. **User Controller**
**File:** `app/Http/Controllers/PenjualanTiketController.php`

**Methods:**
- `show($id)` → Tampilkan detail transaksi dengan status
- `editPayment($id)` → Tampilkan form upload bukti pembayaran
- `submitPayment(PaymentVerificationRequest $request, $id)` → Simpan bukti & kirim ke admin

**Update pada `store()`:**
- Default status menjadi 'pending' saat transaksi dibuat

### 5. **Admin Controller**
**File:** `app/Http/Controllers/Admin/AdminPaymentVerificationController.php`

**Methods:**
- `index()` → List semua pembayaran dengan pagination
- `show($pembayaran)` → Detail pembayaran untuk verifikasi
- `verify(Request $request, $pembayaran)` → Approve pembayaran
- `reject(Request $request, $pembayaran)` → Reject pembayaran
- `filterByStatus($status)` → Filter by pending/verified/rejected

### 6. **Views**

#### User Views:

**a) `resources/views/penjualantiket/payment.blade.php`** (BARU)
- Form upload bukti pembayaran
- Pilihan metode: Transfer, E-wallet, Cash
- Upload gambar dengan drag & drop
- Preview sebelum submit
- Status alert (pending, verified, rejected)
- Input catatan tambahan

**b) `resources/views/penjualantiket/show.blade.php`** (UPDATE)
- Tambah status badge pembayaran
- Tambah button "Verifikasi Pembayaran"
- Tampilkan alert berdasarkan status

#### Admin Views:

**c) `resources/views/admin/pembayaran/index.blade.php`** (BARU)
- List pembayaran dengan filter status
- Badge metode pembayaran
- Filter buttons: Semua, Pending, Verified, Rejected
- Pagination

**d) `resources/views/admin/pembayaran/show.blade.php`** (BARU)
- Detail transaksi lengkap
- Tampil bukti pembayaran (image)
- Form approve dengan catatan
- Form reject dengan alasan
- Status dan info verifikasi jika sudah

### 7. **Routes**
**File:** `routes/web.php`

**User Routes:**
```
GET    /penjualantiket/{id}              → show()
GET    /penjualantiket/{id}/payment      → editPayment()
POST   /penjualantiket/{id}/payment      → submitPayment()
GET    /penjualantiket/{id}/print        → print()
```

**Admin Routes:**
```
GET    /admin/pembayaran                 → index()
GET    /admin/pembayaran/{id}            → show()
POST   /admin/pembayaran/{id}/verify     → verify()
POST   /admin/pembayaran/{id}/reject     → reject()
GET    /admin/pembayaran/filter/{status} → filterByStatus()
```

---

## 🚀 CARA MENGGUNAKAN

### Untuk User (Pendaki):

1. **Buat Transaksi**
   - Go to: `/penjualantiket` → Create
   - Pilih pemesanan → Submit
   - Status otomatis: **Pending**

2. **Upload Bukti Pembayaran**
   - Klik button "Verifikasi Pembayaran"
   - Pilih metode: Transfer, E-wallet, atau Cash
   - Untuk transfer/e-wallet: Upload bukti (screenshot)
   - Klik "Kirim Bukti Pembayaran"

3. **Tunggu Verifikasi Admin**
   - Status berubah dari "Pending" → "Verified" atau "Rejected"
   - Jika rejected, bisa upload ulang

### Untuk Admin:

1. **Lihat Daftar Pembayaran Menunggu**
   - Go to: `/admin/pembayaran`
   - Filter: "Pending"

2. **Verifikasi Pembayaran**
   - Klik "Lihat" → View detail
   - Cek bukti pembayaran (klik "Lihat Gambar")
   - Pilih "Setujui Pembayaran" atau "Tolak Pembayaran"

3. **Approve atau Reject**
   - **Approve:** Tambah catatan (opsional) → Click "Verifikasi Pembayaran"
   - **Reject:** Isi alasan penolakan → Click "Tolak Pembayaran"

---

## 📊 WORKFLOW DATA

```
User Create Transaction (Pending)
        ↓
User Upload Payment Proof
        ↓
Admin Review Proof
        ├→ APPROVE → Status: Verified ✅
        └→ REJECT → Status: Rejected ❌
                    User Upload Again
```

---

## 🗂️ STRUKTUR FOLDER

```
app/
  Http/
    Controllers/
      PenjualanTiketController.php (UPDATE)
      Admin/
        AdminPaymentVerificationController.php (BARU)
    Requests/
      PaymentVerificationRequest.php (BARU)
  Models/
    Penjualantiket.php (UPDATE)

database/
  migrations/
    2026_01_14_000001_add_payment_verification_to_penjualan_tiket.php (BARU)

resources/
  views/
    penjualantiket/
      show.blade.php (UPDATE)
      payment.blade.php (BARU)
    admin/
      pembayaran/
        index.blade.php (BARU)
        show.blade.php (BARU)

routes/
  web.php (UPDATE)
```

---

## 🔒 KEAMANAN

✅ **CSRF Protection** - Form pakai `@csrf`
✅ **Authorization** - Admin-only routes via middleware 'auth' dan 'admin'
✅ **Validation** - PaymentVerificationRequest untuk validasi input
✅ **File Upload** - Max 2MB, image only
✅ **Foreign Key** - verified_by reference ke users table dengan onDelete soft delete

---

## 📝 CATATAN IMPLEMENTASI

1. **Jalankan migration:**
   ```bash
   php artisan migrate
   ```

2. **Storage:** Pastikan storage/app/public/pembayaran accessible
   ```bash
   php artisan storage:link
   ```

3. **Permissions:** Folder storage harus writable

4. **Helper Methods:** Gunakan di views:
   - `$transaksi->isPending()` 
   - `$transaksi->isVerified()`
   - `$transaksi->isRejected()`

---

## 🎯 STATUS FLOW

```
PENDING (User upload proof)
   ↓ ↓
   VERIFIED (Admin approve) ✅
   REJECTED (Admin reject) ❌
```

---

## 📞 KONTACTS

Untuk pertanyaan atau issue terkait sistem verifikasi pembayaran, hubungi admin system.
