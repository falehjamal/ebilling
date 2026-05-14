<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardCabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataLokasiController;
use App\Http\Controllers\DataWargaStoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('billing.auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/dashboard-cabang', DashboardCabangController::class)->name('dashboard-cabang');
    Route::get('/data-warga-sto', DataWargaStoController::class)->name('data-warga-sto');

    Route::resource('data-lokasi', DataLokasiController::class)
        ->except(['show'])
        ->parameters(['data-lokasi' => 'id']);
});
