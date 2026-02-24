<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Penjualantiket;
use App\Models\Detailpendaki;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard - Show statistics
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPemesanan = Pemesanan::count();
        $totalTransaksi = Penjualantiket::count();
        $totalPendaki = Detailpendaki::count();
        
        $recentPemesanan = Pemesanan::latest()->take(5)->get();
        $recentTransaksi = Penjualantiket::with('pemesanan')->latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalPemesanan' => $totalPemesanan,
            'totalTransaksi' => $totalTransaksi,
            'totalPendaki' => $totalPendaki,
            'recentPemesanan' => $recentPemesanan,
            'recentTransaksi' => $recentTransaksi,
        ]);
    }
}
