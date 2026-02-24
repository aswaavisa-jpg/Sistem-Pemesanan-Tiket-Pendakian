# 🛡️ ADMIN PANEL - DOKUMENTASI LENGKAP

## ✅ Status: IMPLEMENTASI SELESAI

---

## 📌 AKSES ADMIN PANEL

**URL:** `http://localhost/tiket_pendakian/admin/dashboard`

**Requirements:**
- ✅ Sudah login
- ✅ User dengan role "Admin"
- ✅ Redirect otomatis jika belum login atau bukan admin

---

## 👤 Admin Account (Test)

```
Email: admin@tiketpendakian.com
Password: admin123
```

---

## 🎨 DESIGN & TEMA

Admin Panel menggunakan **tema yang sama** dengan aplikasi utama:
- **Color Scheme**: Gradient biru (#4fa3c7 → #8fd3ea)
- **Accent Color**: Yellow (#facc15)
- **Framework**: Bootstrap 5.3.3
- **Icons**: Bootstrap Icons
- **Font**: Segoe UI

**Layout**: Sidebar + Main Content
- Sidebar tetap (260px width)
- Responsive pada mobile
- Active menu indicator
- Smooth transitions

---

## 📊 DASHBOARD ADMIN

**Widgets:**
1. **Total Users** - Jumlah seluruh user terdaftar
2. **Total Pemesanan** - Jumlah pemesanan yang dibuat
3. **Total Transaksi** - Jumlah tiket yang terjual
4. **Total Pendaki** - Jumlah pendaki yang terdaftar

**Tables:**
1. **Pemesanan Terbaru** - 5 pemesanan terbaru dengan detail
2. **Transaksi Terbaru** - 5 transaksi terbaru dengan detail

---

## 🔧 FITUR ADMIN

### 1️⃣ **Kelola Users**
- ✅ List semua users (paginated)
- ✅ Tambah user baru (Admin/Pendaki)
- ✅ Edit user (nama, email, role, password)
- ✅ Hapus user
- ✅ Status verifikasi email

**Route**: `/admin/users`

**Actions:**
- `GET /admin/users` - List users
- `GET /admin/users/create` - Form create
- `POST /admin/users` - Store
- `GET /admin/users/{id}/edit` - Form edit
- `PUT /admin/users/{id}` - Update
- `DELETE /admin/users/{id}` - Delete

### 2️⃣ **Data Pendaki**
- ✅ List semua pendaki yang terdaftar
- ✅ Lihat detail lengkap (nama, NIK, alamat, dll)
- ✅ Hapus data pendaki

**Route**: `/admin/pendaki`

**Fields Ditampilkan:**
- Nama
- NIK
- No HP
- Jenis Kelamin
- Alamat lengkap (dusun, desa, RT/RW, kecamatan, kabupaten, provinsi)

### 3️⃣ **Pemesanan**
- ✅ List semua pemesanan
- ✅ Lihat detail pemesanan + daftar pendaki
- ✅ Hapus pemesanan

**Route**: `/admin/pemesanan`

**Fields Ditampilkan:**
- ID Pemesanan
- Jalur Pendakian
- Tanggal Naik
- Tanggal Turun
- Jumlah Anggota

### 4️⃣ **Transaksi Tiket**
- ✅ List semua transaksi penjualan tiket
- ✅ Lihat detail transaksi
- ✅ Lihat struk/receipt
- ✅ Hapus transaksi

**Route**: `/admin/transaksi`

**Fields Ditampilkan:**
- Kode Tiket (unik)
- Jalur Pendakian
- Jumlah Tiket
- Total Harga (Rp)
- Tanggal Transaksi

### 5️⃣ **Gunung**
- ✅ List semua gunung
- ✅ Lihat detail gunung + jadwal pendakian
- ✅ Info jalur dan tinggi gunung

**Route**: `/admin/gunung`

**Fields Ditampilkan:**
- Nama Gunung
- Lokasi
- Tinggi (m)
- Jumlah Jalur

---

## 🔐 KEAMANAN

✅ **Authentication Required**
- Harus login untuk akses admin panel
- Jika belum login → redirect ke `/login`

✅ **Role-Based Access Control**
- Hanya user dengan role "Admin" yang bisa akses
- User biasa → redirect ke dashboard utama dengan pesan error

✅ **CSRF Protection**
- Semua form POST/PUT/DELETE protected dengan @csrf token

✅ **Middleware**
- Custom middleware `IsAdmin` di `app/Http/Middleware/IsAdmin.php`
- Registered di `bootstrap/app.php`

---

## 🗂️ FILES YANG DIBUAT

### Controllers
```
app/Http/Controllers/Admin/
├── AdminController.php              (Dashboard)
├── AdminUsersController.php         (Kelola Users)
├── AdminPendakiController.php       (Data Pendaki)
├── AdminPemesananController.php     (Pemesanan)
├── AdminTransaksiController.php     (Transaksi)
└── AdminGunungController.php        (Gunung)
```

### Views
```
resources/views/admin/
├── layout.blade.php                 (Master layout)
├── dashboard.blade.php              (Dashboard)
├── users/
│   ├── index.blade.php              (List users)
│   ├── create.blade.php             (Form tambah)
│   └── edit.blade.php               (Form edit)
├── pendaki/
│   └── index.blade.php              (List pendaki)
├── pemesanan/
│   └── index.blade.php              (List pemesanan)
├── transaksi/
│   └── index.blade.php              (List transaksi)
└── gunung/
    └── index.blade.php              (List gunung)
```

### Middleware
```
app/Http/Middleware/IsAdmin.php      (Role checking)
```

### Routes
```
routes/web.php                       (Admin routes dengan middleware)
```

---

## 🚀 CARA MENGGUNAKAN

### 1. Login sebagai Admin
```
1. Akses http://localhost/tiket_pendakian/login
2. Email: admin@tiketpendakian.com
3. Password: admin123
4. Klik Login
```

### 2. Akses Admin Panel
```
1. Setelah login, akan redirect ke dashboard
2. Klik tombol "Admin" merah di pojok atas kiri
3. Atau akses langsung: http://localhost/tiket_pendakian/admin/dashboard
```

### 3. Navigasi Sidebar
```
Dashboard        - Overview & statistik
Kelola Users    - CRUD users
Data Pendaki    - List pendaki
Pemesanan       - List pemesanan
Transaksi Tiket - List transaksi
Gunung          - List gunung
Kembali ke Home - Back to main site
```

---

## 📋 TABEL DATA

### Users Table
- ID (Primary Key)
- Nama
- Email (Unique)
- Password (Hashed)
- Role (Admin | Pendaki)
- Email Verified At
- Created At / Updated At

### Pemesanan Table
- ID
- Jalur Pendakian
- Tanggal Naik
- Tanggal Turun
- Jumlah Anggota
- Created At / Updated At

### Penjualan Tiket Table
- ID
- Kode Tiket (Unique)
- Pemesanan ID (FK)
- Harga Per Orang
- Total Harga
- Created At / Updated At

### Detail Pendaki Table
- ID
- Pendaki ID (FK)
- Pemesanan ID (FK)
- Nama, NIK, Jenis Kelamin
- Tanggal Lahir
- No HP
- Alamat lengkap (dusun, desa, rt_rw, kecamatan, kabupaten, provinsi)
- Created At / Updated At

---

## ⚙️ KONFIGURASI

### Middleware Setup
Di `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ]);
})
```

### Routes Setup
Di `routes/web.php`:
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', AdminUsersController::class);
    // ... routes lainnya
});
```

---

## 🎯 FITUR YANG BISA DITAMBAHKAN

### Future Enhancements
1. **Export Data** - Export users/transaksi ke Excel/PDF
2. **Reports** - Laporan penjualan, statistik pendaki
3. **Search & Filter** - Filter pemesanan by status, date range
4. **Bulk Actions** - Delete multiple items sekaligus
5. **Activity Log** - Log semua aksi admin
6. **Dashboard Charts** - Grafik penjualan, pertumbuhan user
7. **Email Notifications** - Notifikasi untuk pemesanan baru
8. **Backup System** - Auto backup database

---

## 🧪 TESTING CHECKLIST

- [ ] Login dengan akun admin
- [ ] Dashboard menampilkan statistik correct
- [ ] Bisa akses semua menu di sidebar
- [ ] List users menampilkan semua users
- [ ] Bisa tambah user baru
- [ ] Bisa edit user (nama, email, role)
- [ ] Bisa hapus user
- [ ] List pendaki menampilkan data correct
- [ ] List pemesanan menampilkan data correct
- [ ] List transaksi menampilkan data correct
- [ ] Pagination bekerja dengan baik
- [ ] Alert success/error muncul dengan benar
- [ ] Redirect otomatis jika belum login
- [ ] Akses admin panel dengan user non-admin → error message
- [ ] Responsive pada mobile

---

## 📞 SUPPORT

Untuk pertanyaan atau masalah:
1. Check route di `routes/web.php`
2. Check controller di `app/Http/Controllers/Admin/`
3. Check view di `resources/views/admin/`
4. Check middleware di `app/Http/Middleware/IsAdmin.php`

---

**✨ Admin Panel Siap Digunakan!**
