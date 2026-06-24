<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserBillingController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\LaporanController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//user

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', [UserBillingController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/user/tagihan', [UserBillingController::class, 'tagihan'])
        ->name('user.tagihan');

    Route::get('/user/pembayaran', [UserBillingController::class, 'riwayat'])
        ->name('user.pembayaran');

    Route::get('/user/tagihan/{billing}/bayar', [UserBillingController::class, 'bayar'])
        ->name('user.billing.pay');
});



//midtrans
Route::post('/midtrans/notification', [PembayaranController::class, 'notification'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->name('midtrans.notification');

//admin
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('kategori', KategoriController::class);
        Route::resource('kelas', KelasController::class)
            ->parameters(['kelas' => 'kelas']);
        Route::resource('siswa', SiswaController::class);
        Route::resource('user', UserController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('pemasukan', PemasukanController::class);
        Route::resource('pengeluaran', PengeluaranController::class);

        //laporan
        Route::get('/laporan/spp',[LaporanController::class, 'spp'])
            ->name('laporan.spp');

        Route::get( '/laporan/spp/pdf', [LaporanController::class, 'sppPdf'])
            ->name('laporan.spp.pdf');

        Route::get('/laporan/aruskas',[LaporanController::class, 'arusKas'])
            ->name('laporan.aruskas');

        Route::get('/arus-kas/pdf',[LaporanController::class, 'arusKasPdf'])
            ->name('aruskas.pdf');

        Route::get('/laporan/aruskas/pdf', [LaporanController::class, 'arusKasPdf'])
            ->name('laporan.aruskas.pdf');
        
        Route::get('/laporan/pemasukan', [LaporanController::class, 'pemasukan'])
            ->name('laporan.pemasukan');

        Route::get('/laporan/pemasukan/pdf', [LaporanController::class, 'pemasukanPdf'])
            ->name('pemasukan.laporan.pdf');

        Route::get('/laporan/pengeluaran', [LaporanController::class, 'pengeluaran'])
            ->name('laporan.pengeluaran');

        Route::get('/laporan/pengeluaran/pdf', [LaporanController::class, 'pengeluaranPdf'])
            ->name('pengeluaran.laporan.pdf');

        //billing & payments
        Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
        Route::get('/billing/create', [BillingController::class, 'create'])->name('billing.create');
        Route::post('/billing/generate', [BillingController::class, 'generate'])->name('billing.generate');

        Route::post('/billing/{billing}/bayar', [PembayaranController::class, 'store'])->name('billing.bayar');

        //midtrans
        Route::get('/billing/{billing}/pay-online', [PembayaranController::class, 'payOnline'])
            ->name('billing.pay-online');
    });

require __DIR__ . '/auth.php';
