<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jalur_pendakian',
        'tgl_naik',
        'tgl_turun',
        'jumlah_anggota',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'tgl_naik' => 'date',
        'tgl_turun' => 'date',
    ];

    public function pendakis()
    {
        return $this->hasMany(Detailpendaki::class);
    }

    public function details()
    {
        return $this->hasMany(Detailpendaki::class);
    }

    public function penjualantiket()
    {
        return $this->hasOne(Penjualantiket::class);
    }
}
