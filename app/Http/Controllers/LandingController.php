<?php

namespace App\Http\Controllers;

use App\Models\Detailpendaki;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Menampilkan Landing Page / Dashboard Utama
     */
    public function index()
    {
        // Hitung pendaki yang statusnya 'aktif' (sedang mendaki)
        $totalPendakiAktif = Detailpendaki::where('status_pendakian', 'aktif')->count();
        
        $maxKuota = 25;
        
        return view('dashboard', compact('totalPendakiAktif', 'maxKuota'));
    }
}
