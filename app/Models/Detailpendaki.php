<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpendaki extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'pendaki_id',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function pendaki()
    {
        return $this->belongsTo(Pendaki::class);
    }
}
