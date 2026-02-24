# 🎯 ADMIN PANEL - QUICK START

## ⚡ AKSES CEPAT

**Admin Login:**
```
Email: admin@tiketpendakian.com
Password: admin123
```

**Admin Dashboard:**
```
http://localhost/tiket_pendakian/admin/dashboard
```

---

## 📊 HALAMAN ADMIN

| Menu | URL | Fungsi |
|------|-----|--------|
| Dashboard | `/admin/dashboard` | Overview & statistik |
| Kelola Users | `/admin/users` | CRUD users |
| Data Pendaki | `/admin/pendaki` | Lihat & hapus pendaki |
| Pemesanan | `/admin/pemesanan` | Lihat & hapus pemesanan |
| Transaksi | `/admin/transaksi` | Lihat & hapus transaksi |
| Gunung | `/admin/gunung` | Lihat gunung |

---

## 🎨 DESIGN

- **Color**: Gradient Biru (#4fa3c7 - #8fd3ea)
- **Accent**: Yellow (#facc15)
- **Layout**: Sidebar + Content
- **Framework**: Bootstrap 5

---

## 🔐 SECURITY

✅ Auth Required  
✅ Admin Role Check  
✅ CSRF Protection  
✅ Permission Middleware  

---

## ✅ FEATURES

### Kelola Users
- ✅ List (with pagination)
- ✅ Create (Admin/Pendaki)
- ✅ Edit (name, email, role, password)
- ✅ Delete
- ✅ Email verification status

### Data Pendaki
- ✅ List dengan pagination
- ✅ Lihat detail
- ✅ Hapus

### Pemesanan
- ✅ List semua pemesanan
- ✅ Lihat detail
- ✅ Hapus

### Transaksi
- ✅ List transaksi penjualan
- ✅ Lihat receipt
- ✅ Hapus

### Gunung
- ✅ List gunung
- ✅ Lihat detail + jadwal

---

## 🚀 FIRST TIME SETUP

1. **Login**
   ```
   http://localhost/tiket_pendakian/login
   ```

2. **Access Admin**
   ```
   Click "Admin" button (red) at top-left
   Or: http://localhost/tiket_pendakian/admin/dashboard
   ```

3. **Manage Content**
   - Use sidebar to navigate
   - Create/Edit/Delete as needed

---

## 💡 TIPS

- Click sidebar item to navigate
- Tables support pagination (15 per page)
- Confirm dialog on delete action
- Edit user: password is optional
- All timestamps in admin local timezone

---

## 📚 Full Documentation

See `ADMIN_PANEL_DOCUMENTATION.md` for complete guide.

---

**Ready to manage your mountain climbing platform! 🏔️**
