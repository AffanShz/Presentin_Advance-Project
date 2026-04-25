<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterTutorialController;
use App\Http\Controllers\DetailTutorialController;
use App\Http\Controllers\PublicTutorialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Public Auth Routes ---
// Default route redirect
Route::redirect('/', '/login');

// Halaman login dan aksi login menggunakan API eksternal
Route::view('/login', 'login')->name('login');
Route::post('/login-action', [AuthController::class, 'login']);

// --- Protected Routes (Route Guard) ---
// Semua rute di dalam grup ini dilindungi oleh Middleware CheckAuthToken
Route::middleware([\App\Http\Middleware\CheckAuthToken::class])->group(function() {

    // Aksi Logout
    Route::get('/logout-action', [AuthController::class, 'logout']);

    // Manajemen Master Tutorial (Analogi: Header Data CRUD)
    Route::get('/master-tutorial', [MasterTutorialController::class, 'index']);
    Route::get('/master-tutorial/create', [MasterTutorialController::class, 'create']);
    Route::post('/master-tutorial', [MasterTutorialController::class, 'store']);
    Route::get('/master-tutorial/{id}/edit', [MasterTutorialController::class, 'edit']);
    Route::put('/master-tutorial/{id}', [MasterTutorialController::class, 'update']);
    Route::delete('/master-tutorial/{id}', [MasterTutorialController::class, 'destroy']);

    // Manajemen Detail Tutorial (Analogi: Sub-item / Steps CRUD)
    // show() digunakan untuk halaman 'Kelola Langkah' atau 'Manage Details'
    Route::get('/master-tutorial/{id}/detail', [DetailTutorialController::class, 'show']);
    Route::post('/detail-tutorial', [DetailTutorialController::class, 'store']);
    Route::put('/detail-tutorial/{id}', [DetailTutorialController::class, 'update']);
    Route::delete('/detail-tutorial/{id}', [DetailTutorialController::class, 'destroy']);

});

// --- Public Viewing Routes ---
// Poin 8: Halaman Presentasi Mahasiswa dengan fitur Auto-Refresh
// Route ini menangkap slug dari URL unik yang di-generate saat create master
Route::get('/presentation/{slug}', [PublicTutorialController::class, 'presentation']);

// Halaman Finished (Opsional untuk UTS, rute disiapkan untuk integrasi PDF nantinya)
Route::get('/finished/{slug}', [PublicTutorialController::class, 'finished']);