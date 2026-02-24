<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualantiket extends Model
{
    use HasFactory;

    protected $table = 'penjualan_tiket';

    protected $fillable = [
        'kode_tiket',
        'nama_pendaki',
        'tanggal_pendakian',
        'jumlah_tiket',
        'total_harga',
        'pemesanan_id',
        'harga_per_orang',
        'status_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
        'verified_by',
        'verified_at',
        'catatan_verifikasi',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if payment is verified
     */
    public function isVerified()
    {
        return $this->status_pembayaran === 'verified';
    }

    /**
     * Check if payment is pending
     */
    public function isPending()
    {
        return $this->status_pembayaran === 'pending';
    }

    /**
     * Check if payment is rejected
     */
    public function isRejected()
    {
        return $this->status_pembayaran === 'rejected';
    }
}
