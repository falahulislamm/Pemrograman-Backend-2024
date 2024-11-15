<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function(){
    // Group route ini hanya bisa diakses oleh user yang sudah terautentikasi dengan Sanctum
    Route::get('/patients', [PasienController::class, 'index']); 
    // Menampilkan semua data pasien

    Route::post('/patients', [PasienController::class, 'store']); 
    // Menambahkan pasien baru

    Route::put('/patients/{id}', [PasienController::class, 'update']); 
    // Mengupdate data pasien berdasarkan ID

    Route::delete('/patients/{id}', [PasienController::class, 'destroy']); 
    // Menghapus data pasien berdasarkan ID

    Route::get('/patients/{id}', [PasienController::class, 'show']); 
    // Menampilkan detail pasien berdasarkan ID

    Route::get('/patients/search/{name}', [PasienController::class, 'search_name']); 
    // Mencari pasien berdasarkan nama

    Route::get('/patients/status/positive', [PasienController::class, 'getPositiveResources']); 
    // Menampilkan pasien dengan status 'Positive'

    Route::get('/patients/status/recovered', [PasienController::class, 'getRecoveredResources']); 
    // Menampilkan pasien dengan status 'Recovered'

    Route::get('/patients/status/dead', [PasienController::class, 'getDeadResources']); 
    // Menampilkan pasien dengan status 'Dead'
});


// Route untuk registrasi user
Route::post('/register', [AuthController::class, 'register']); 
// Mengirimkan data untuk registrasi user baru

// Route untuk login user
Route::post('/login', [AuthController::class, 'login']); 
// Mengirimkan data untuk login dan mendapatkan token
