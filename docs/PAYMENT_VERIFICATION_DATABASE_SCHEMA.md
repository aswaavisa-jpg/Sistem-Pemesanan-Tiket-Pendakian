# 📊 PAYMENT VERIFICATION DATABASE SCHEMA

## Tabel: penjualan_tiket (UPDATED)

```sql
CREATE TABLE penjualan_tiket (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    
    -- Existing Columns
    kode_tiket VARCHAR(255) UNIQUE NOT NULL,
    nama_pendaki VARCHAR(255) NOT NULL,
    tanggal_pendakian DATE NOT NULL,
    jumlah_tiket INT NOT NULL,
    total_harga INT NOT NULL,
    harga_per_orang INT NULL,
    pemesanan_id BIGINT UNSIGNED,
    
    -- NEW: Payment Verification Columns
    status_pembayaran ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
    metode_pembayaran VARCHAR(255) NULL,
    bukti_pembayaran VARCHAR(255) NULL,
    verified_by BIGINT UNSIGNED NULL,
    verified_at TIMESTAMP NULL,
    catatan_verifikasi TEXT NULL,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Constraints
    FOREIGN KEY (pemesanan_id) REFERENCES pemesanans(id),
    FOREIGN KEY (verified_by) REFERENCES users(id) ON DELETE SET NULL
);
```

---

## Column Details

### Payment Verification Columns:

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| `status_pembayaran` | ENUM | ❌ No | 'pending' | Status: pending, verified, atau rejected |
| `metode_pembayaran` | VARCHAR(255) | ✅ Yes | NULL | Metode: transfer, e-wallet, atau cash |
| `bukti_pembayaran` | VARCHAR(255) | ✅ Yes | NULL | Path file bukti pembayaran di storage |
| `verified_by` | BIGINT UNSIGNED | ✅ Yes | NULL | User ID admin yang melakukan verifikasi |
| `verified_at` | TIMESTAMP | ✅ Yes | NULL | Waktu verifikasi dilakukan |
| `catatan_verifikasi` | TEXT | ✅ Yes | NULL | Catatan/alasan dari admin |

---

## Relationships Diagram

```
┌──────────────────────────────┐
│      users (admin)           │
├──────────────────────────────┤
│ id (PK)                      │
│ name                         │
│ email                        │
│ password                     │
│ role (admin/pendaki)         │
└──────────────────────────────┘
           ▲
           │ FK: verified_by
           │
┌──────────────────────────────────────────────────┐
│         penjualan_tiket                          │
├──────────────────────────────────────────────────┤
│ id (PK)                                          │
│ kode_tiket (UNIQUE)                              │
│ nama_pendaki                                     │
│ tanggal_pendakian                                │
│ jumlah_tiket                                     │
│ total_harga                                      │
│ harga_per_orang                                  │
│ pemesanan_id (FK) ──────┐                        │
│                         │                        │
│ status_pembayaran ◄──── │ (NEW)                  │
│ metode_pembayaran (NEW) │                        │
│ bukti_pembayaran (NEW)  │                        │
│ verified_by (FK) ───────┤──► users.id (admin)    │
│ verified_at (NEW)       │                        │
│ catatan_verifikasi      │                        │
│ created_at              │                        │
│ updated_at              │                        │
└──────────────────────────────────────────────────┘
           │
           │ FK: pemesanan_id
           ▼
┌──────────────────────────────┐
│       pemesanans             │
├──────────────────────────────┤
│ id (PK)                      │
│ jalur_pendakian              │
│ tgl_naik                     │
│ tgl_turun                    │
│ jumlah_anggota               │
│ created_at                   │
│ updated_at                   │
└──────────────────────────────┘
```

---

## Status Flow Diagram

```
┌──────────────────────────────────────────────────────────┐
│                    PENDING (Default)                      │
│         User hasn't uploaded payment proof yet           │
│   status_pembayaran = 'pending', verified_by = NULL     │
└────────────┬─────────────────────────────┬───────────────┘
             │                             │
             ▼ User uploads proof          ▼ Status remains pending
    ┌────────────────────────────┐   Status: PENDING
    │  (still PENDING)            │   Waiting for admin verification
    │  - metode_pembayaran set    │
    │  - bukti_pembayaran saved   │
    │  - verified_by: NULL        │
    └────────────┬────────┬───────┘
                 │        │
    ┌────────────▼─┐  ┌──▼────────────────┐
    │              │  │                   │
    ▼              ▼  ▼                   ▼
┌──────────────────────────────┐  ┌──────────────────────┐
│       VERIFIED ✅            │  │    REJECTED ❌       │
│ Admin approved payment       │  │ Admin rejected       │
│ status = 'verified'          │  │ status = 'rejected'  │
│ verified_by = admin_id       │  │ verified_by = admin  │
│ verified_at = timestamp      │  │ verified_at = time   │
│ catatan_verifikasi = notes   │  │ catatan = reason     │
└──────────────────────────────┘  └──────┬───────────────┘
                                         │
                                    User can
                                 re-upload proof
                                         │
                                    Goes back to PENDING
                                         ▼
                              ┌────────────────────┐
                              │   PENDING (again)  │
                              └────────────────────┘
```

---

## Data Examples

### Example 1: Pending Payment
```json
{
  "id": 1,
  "kode_tiket": "TK-3F7A2B9E",
  "nama_pendaki": "Mt. Semeru",
  "tanggal_pendakian": "2026-02-15",
  "jumlah_tiket": 3,
  "total_harga": 60000,
  "harga_per_orang": 20000,
  "pemesanan_id": 5,
  "status_pembayaran": "pending",
  "metode_pembayaran": "transfer",
  "bukti_pembayaran": "pembayaran/bukti_1_1705208400.jpg",
  "verified_by": null,
  "verified_at": null,
  "catatan_verifikasi": null,
  "created_at": "2026-01-14 10:30:00",
  "updated_at": "2026-01-14 10:30:00"
}
```

### Example 2: Verified Payment
```json
{
  "id": 2,
  "kode_tiket": "TK-5K8L2P3Q",
  "nama_pendaki": "Mt. Bromo",
  "tanggal_pendakian": "2026-02-20",
  "jumlah_tiket": 2,
  "total_harga": 40000,
  "harga_per_orang": 20000,
  "pemesanan_id": 6,
  "status_pembayaran": "verified",
  "metode_pembayaran": "e-wallet",
  "bukti_pembayaran": "pembayaran/bukti_2_1705210500.jpg",
  "verified_by": 1,
  "verified_at": "2026-01-14 11:45:00",
  "catatan_verifikasi": "Pembayaran valid, transfer diterima dengan baik",
  "created_at": "2026-01-14 10:45:00",
  "updated_at": "2026-01-14 11:45:00"
}
```

### Example 3: Rejected Payment
```json
{
  "id": 3,
  "kode_tiket": "TK-7X9Y1Z2C",
  "nama_pendaki": "Mt. Rinjani",
  "tanggal_pendakian": "2026-03-01",
  "jumlah_tiket": 4,
  "total_harga": 80000,
  "harga_per_orang": 20000,
  "pemesanan_id": 7,
  "status_pembayaran": "rejected",
  "metode_pembayaran": "transfer",
  "bukti_pembayaran": "pembayaran/bukti_3_1705210800.jpg",
  "verified_by": 1,
  "verified_at": "2026-01-14 12:00:00",
  "catatan_verifikasi": "DITOLAK: Nominal tidak sesuai, seharusnya Rp 80.000 tapi bukti hanya Rp 60.000",
  "created_at": "2026-01-14 10:50:00",
  "updated_at": "2026-01-14 12:00:00"
}
```

---

## Query Examples

### Get all pending payments
```sql
SELECT * FROM penjualan_tiket 
WHERE status_pembayaran = 'pending' 
ORDER BY created_at ASC;
```

### Get verified payments with admin info
```sql
SELECT 
    pt.*,
    u.name as admin_name,
    u.email as admin_email
FROM penjualan_tiket pt
LEFT JOIN users u ON pt.verified_by = u.id
WHERE pt.status_pembayaran = 'verified'
ORDER BY pt.verified_at DESC;
```

### Get rejected payments to re-verify
```sql
SELECT * FROM penjualan_tiket 
WHERE status_pembayaran = 'rejected' 
ORDER BY verified_at DESC;
```

### Count payments by status
```sql
SELECT 
    status_pembayaran,
    COUNT(*) as total
FROM penjualan_tiket 
GROUP BY status_pembayaran;
```

### Get payments verified by specific admin
```sql
SELECT * FROM penjualan_tiket 
WHERE verified_by = 1 
ORDER BY verified_at DESC;
```

---

## File Storage Structure

```
storage/app/public/pembayaran/
├── bukti_1_1705208400.jpg      (Payment proof for transaction 1)
├── bukti_2_1705210500.jpg      (Payment proof for transaction 2)
├── bukti_3_1705210800.jpg      (Payment proof for transaction 3)
└── ...
```

---

## Migration Details

**File:** `database/migrations/2026_01_14_000001_add_payment_verification_to_penjualan_tiket.php`

**Actions:**
- ✅ Add 6 new columns to `penjualan_tiket` table
- ✅ Create foreign key constraint: `verified_by` → `users.id`
- ✅ Set `status_pembayaran` default to 'pending'
- ✅ Allow NULL for payment-related fields

**Reversible:**
- ✅ Down method drops all columns and foreign key constraint

---

## Performance Considerations

### Recommended Indexes:
```sql
-- For filtering by status
CREATE INDEX idx_status_pembayaran ON penjualan_tiket(status_pembayaran);

-- For finding user's verified payments
CREATE INDEX idx_verified_by ON penjualan_tiket(verified_by);

-- For listing by created date
CREATE INDEX idx_created_at ON penjualan_tiket(created_at);

-- For finding pending payments quickly
CREATE INDEX idx_pending_payments ON penjualan_tiket(status_pembayaran, created_at);
```

---

## Data Retention Policy

- ✅ Keep all payment proofs (images) for audit trail
- ✅ Store payment history (never delete)
- ✅ Archive old payments after 1 year (optional)
- ✅ Regular database backups recommended

---

## Compliance & Security

- ✅ Payment data stored securely in database
- ✅ File proofs stored with secure permissions
- ✅ Admin audit trail (who verified and when)
- ✅ Rejection reasons documented
- ✅ Foreign key constraints ensure data integrity

---

**Schema Version:** 1.0
**Last Updated:** 2026-01-14
**Status:** ✅ Active & In Production
