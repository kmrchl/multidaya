<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeuanganController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/* =========================
   PUBLIC ROUTES
========================= */

Route::get('/test', function () {
    return response()->json(['message' => 'OK']);
});


/* =========================
   ROOT REDIRECT
========================= */
Route::get('/', function () {
    return redirect()->route('dashboard');
});


  /* =========================
   AUTH REQUIRED ROUTES
========================= */
Route::middleware(['auth'])->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /* LOGOUT (pakai Breeze) */
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    /* =====================
       PEMINJAMAN
    ===================== */
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::post('/', [PeminjamanController::class, 'store'])->name('store');
        Route::get('/{id}', [PeminjamanController::class, 'show'])->name('show');
        Route::put('/{id}', [PeminjamanController::class, 'update'])->name('update');
        Route::put('/{id}/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');
        Route::delete('/{id}', [PeminjamanController::class, 'destroy'])->name('destroy');
    });

    /* =====================
       BARANG
    ===================== */
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('index');
        Route::get('/all', [BarangController::class, 'getAllData'])->name('all');
        Route::post('/', [BarangController::class, 'store'])->name('store');
        Route::get('/{id}', [BarangController::class, 'show'])->name('show');
        Route::put('/{id}', [BarangController::class, 'update'])->name('update');
        Route::delete('/{id}', [BarangController::class, 'destroy'])->name('destroy');
    });

    /* =====================
       KEUANGAN
    ===================== */
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('index');
        Route::post('/', [KeuanganController::class, 'store'])->name('store');
        Route::delete('/{id}', [KeuanganController::class, 'destroy'])->name('destroy');

        Route::get('/pendapatan', [KeuanganController::class, 'pendapatan'])->name('pendapatan');
        Route::get('/pengeluaran', [KeuanganController::class, 'pengeluaran'])->name('pengeluaran');
        Route::get('/laba', [KeuanganController::class, 'laba'])->name('laba');

        Route::get('/riwayat-json', [KeuanganController::class, 'getRiwayatByDate'])->name('riwayat.json');
        Route::get('/detail/{id}', [KeuanganController::class, 'show'])->name('show');
    });

    /* =====================
       API SIMPLE
    ===================== */
    Route::get('/api/barang-tersedia', function () {
        return response()->json(
            \App\Models\Barang::where('status', 'aktif')
                ->where('tersedia', '>', 0)
                ->get(['id', 'kode_barang', 'nama_barang', 'harga_sewa', 'tersedia'])
        );
    });

    /* =====================
       DASHBOARD FEATURES
    ===================== */
    Route::post('/send-whatsapp', [DashboardController::class, 'sendWhatsAppNotification'])->name('send-whatsapp');

    Route::get('/notifications', [DashboardController::class, 'getNotifications'])->name('notifications');
    Route::post('/notifications/{id}/read', [DashboardController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [DashboardController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::get('/notifications/count', [DashboardController::class, 'getNotificationCount'])->name('notifications.count');

    Route::get('/recommendations', [DashboardController::class, 'getRecommendations'])->name('recommendations');
    Route::post('/recommendations/accept', [DashboardController::class, 'acceptRecommendation'])->name('recommendations.accept');
    Route::get('/recommendations/refresh', [DashboardController::class, 'refreshRecommendations'])->name('recommendations.refresh');

});
