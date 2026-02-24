<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendakiController;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\JadwalPendakianController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailPendakiController;
use App\Http\Controllers\PenjualantiketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminPendakiController;
use App\Http\Controllers\Admin\AdminPemesananController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminPaymentVerificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminChatController;
// NewsletterController removed per user request
/*
|--------------------------------------------------------------------------
| AUTENTIKASI 
|--------------------------------------------------------------------------
| Mengatur rute untuk login, registrasi, dan logout.
|
*/
// Menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Memproses data login
Route::post('/login', [LoginController::class, 'login']);
// Memproses logout user
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Menampilkan form registrasi user baru
Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
// Memproses pendaftaran user baru
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| DASHBOARD & HALAMAN UMUM (General Pages)
|--------------------------------------------------------------------------
| Halaman yang dapat diakses oleh publik tanpa harus login.
| Disinilah rute '/' diubah agar langsung menampilkan dashboard utama.
|
*/
// Rute utama: Menampilkan Dashboard Pendakian (Bisa diakses tanpa login)
Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('dashboard');

// Halaman Kontak
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

// Newsletter subscribe route removed

// Halaman Informasi Persyaratan Pendaki
Route::get('/persyaratan-pendaki', function () {
    return view('informasi.persyaratan');
})->name('persyaratan');

// Halaman Informasi Perlengkapan
Route::get('/perlengkapan', function () {
    return view('perlengkapan');
})->name('perlengkapan');

// Halaman Daftar/Informasi Jalur Pendakian
Route::get('/jalur-pendakian', function () {
    return view('jalur.index');
})->name('jalur');

/*
|--------------------------------------------------------------------------
| PEMESANAN (Booking)
|--------------------------------------------------------------------------
| Mengelola proses booking pendakian.
|
*/
// Rute untuk membuat, mengedit, dan menghapus pemesanan (Memerlukan Login)
Route::resource('pemesanan', PemesananController::class)->except(['index', 'show'])->middleware('auth');
// Rute untuk melihat daftar dan detail pemesanan (Bisa tanpa login/umum)
Route::resource('pemesanan', PemesananController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| DETAIL PENDAKI 
|--------------------------------------------------------------------------
| Mengelola data anggota pendaki yang terdaftar dalam satu pemesanan.
|
*/
Route::resource('detailpendaki', DetailPendakiController::class);

/*
|--------------------------------------------------------------------------
| PENJUALAN TIKET / TRANSAKSI 
|--------------------------------------------------------------------------
| Mengelola data transaksi pembayaran tiket pendakian.
|
*/
// Rute untuk transaksi tiket (Memerlukan Login)
Route::middleware('auth')->group(function() {
    Route::resource('penjualantiket', PenjualantiketController::class);
    
    // Fitur Chat User
    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

    // Menampilkan halaman upload bukti pembayaran
    Route::get('penjualantiket/{id}/payment', [PenjualantiketController::class, 'editPayment'])->name('penjualantiket.editPayment');
    
    // Memproses upload bukti pembayaran
    Route::post('penjualantiket/{id}/payment', [PenjualantiketController::class, 'submitPayment'])->name('penjualantiket.submitPayment');
    
    // Mengunduh atau mencetak tiket hasil transaksi
    Route::get('penjualantiket/{id}/print', [PenjualantiketController::class, 'print'])->name('penjualantiket.print');
});
// Proses checkout langsung dari detail pendaki
Route::get('penjualantiket/checkout/{pemesanan_id}', [PenjualantiketController::class, 'checkout'])->name('penjualantiket.checkout')->middleware('auth');


/* SCAN QR CODE TIKET (Public - tanpa login) */
Route::get(
    'tiket/scan/{kode_tiket}',
    [PenjualantiketController::class, 'scanTicket']
)->name('penjualantiket.scan');

/*
|--------------------------------------------------------------------------
| MASTER DATA
|--------------------------------------------------------------------------
| Mengelola data dasar seperti daftar pendaki, gunung, dan jadwal.
|
*/
// Cek NIK apakah sudah terdaftar atau belum (via AJAX/API)
Route::get('pendaki/check-nik', [PendakiController::class, 'checkNik'])->name('pendaki.checkNik');
// CRUD Data Pendaki
Route::resource('pendaki', PendakiController::class);
// CRUD Data Gunung
Route::resource('gunung', GunungController::class);
// CRUD Jadwal Pendakian
Route::resource('jadwalpendakian', JadwalPendakianController::class);

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
| Area khusus Administrator yang dilindungi middleware 'auth' dan 'admin'.
|
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard khusus Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Manajemen User (Admin/User biasa)
    Route::resource('users', AdminUsersController::class);
    
    // Manajemen Data Pendaki oleh Admin
    Route::resource('pendaki', AdminPendakiController::class);
    // Filter data pendaki
    Route::match(['get', 'post'], 'pendaki/data/filter', [AdminPendakiController::class, 'pendakiFilter'])->name('pendaki.filter');
    // Laporan data pendaki
    Route::get('pendaki/laporan/data', [AdminPendakiController::class, 'report'])->name('pendaki.report');
    // Filter laporan data pendaki
    Route::match(['get', 'post'], 'pendaki/laporan/filter', [AdminPendakiController::class, 'reportFilter'])->name('pendaki.reportFilter');
    // Detail transaksi dari sisi admin
    Route::get('pendaki/transaksi/{id}/detail', [AdminPendakiController::class, 'transactionDetail'])->name('pendaki.transactionDetail');
    // Konfirmasi pendaki telah turun
    Route::post('pendaki/{id}/confirm-descent', [AdminPendakiController::class, 'confirmDescent'])->name('pendaki.confirmDescent');
    
    // Manajemen Pemesanan oleh Admin
    Route::resource('pemesanan', AdminPemesananController::class);
    
    // Manajemen Transaksi/Penjualan Tiket oleh Admin
    Route::resource('transaksi', AdminTransaksiController::class);

    // Manajemen Chat oleh Admin
    Route::get('chat', [AdminChatController::class, 'index'])->name('chat.index');
    Route::get('chat/{user}', [AdminChatController::class, 'show'])->name('chat.show');
    Route::post('chat/{user}/reply', [AdminChatController::class, 'reply'])->name('chat.reply');

    /* VERIFIKASI PEMBAYARAN (Admin) */
    // Menampilkan daftar pembayaran yang perlu diverifikasi
    Route::resource('pembayaran', AdminPaymentVerificationController::class)->only(['index', 'show']);
    // Menyetujui/Verifikasi pembayaran
    Route::post('pembayaran/{pembayaran}/verify', [AdminPaymentVerificationController::class, 'verify'])->name('pembayaran.verify');
    // Menolak pembayaran
    Route::post('pembayaran/{pembayaran}/reject', [AdminPaymentVerificationController::class, 'reject'])->name('pembayaran.reject');
    // Filter daftar pembayaran berdasarkan status
    Route::get('pembayaran/filter/{status}', [AdminPaymentVerificationController::class, 'filterByStatus'])->name('pembayaran.filterByStatus');
});
