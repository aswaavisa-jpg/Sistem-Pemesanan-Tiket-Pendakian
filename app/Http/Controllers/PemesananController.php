<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pendaki;
use App\Models\Gunung;
use App\Models\Jadwalpendakian;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with(['pendaki', 'gunung', 'jadwalPendakian'])->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
{
    $gunung = Gunung::all();
    $jadwal = Jadwalpendakian::all();
    $pendaki = Pendaki::all();

    return view('pemesanan.create', compact('gunung','jadwal','pendaki'));
}



    public function store(Request $request)
{
    $request->validate([
    'nama_pendaki'     => 'required|string',
    'jalur_pendakian'  => 'required',
    'tgl_naik'         => 'required|date',
    'tgl_turun'       => 'required|date',
    'jumlah_anggota'   => 'required|integer|min:1',
]);


    \App\Models\Pemesanan::create($request->all());

    return redirect('/pendaki')->send();

}



    public function show(Pemesanan $pemesanan)
    {
        return view('pemesanan.show', compact('pemesanan'));
    }
}
