<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaki extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'no_hp_darurat',
        'dusun',
        'desa',
        'rt_rw',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'foto',
        'foto_ktp',
        'foto_selfie',
    ];

    public function details()
    {
        return $this->hasMany(Detailpendaki::class);
    }
}
