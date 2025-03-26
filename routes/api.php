<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\IuranWargaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\JadwalRondaController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TagihanController;

// autentikasi
Route::post('/login', [AuthController::class, 'login']);

// Group Admin
Route::middleware(['auth:sanctum',  RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/getuser', [UserController::class, 'index']);

    // iuran warga
    Route::get('iuran-warga', [IuranWargaController::class, 'index']);
    Route::post('iuran-warga', [IuranWargaController::class, 'store']);
    Route::get('iuran-warga/{iuran_warga}', [IuranWargaController::class, 'show']);
    Route::put('iuran-warga/{iuran_warga}', [IuranWargaController::class, 'update']);
    Route::delete('iuran-warga/{iuran_warga}', [IuranWargaController::class, 'destroy']);

    // warga
    Route::get('warga', [WargaController::class, 'index']);
    Route::post('warga', [WargaController::class, 'store']);
    Route::get('warga/{warga}', [WargaController::class, 'show']);
    Route::put('warga/{warga}', [WargaController::class, 'update']);
    Route::delete('warga/{warga}', [WargaController::class, 'destroy']);

    // pengumuman
    Route::get('pengumuman', [PengumumanController::class, 'index']);
    Route::post('pengumuman', [PengumumanController::class, 'store']);
    Route::get('pengumuman/{pengumuman}', [PengumumanController::class, 'show']);
    Route::put('pengumuman/{pengumuman}', [PengumumanController::class, 'update']);
    Route::delete('pengumuman/{pengumuman}', [PengumumanController::class, 'destroy']);

    // jadwal ronda
    Route::get('jadwal-ronda', [JadwalRondaController::class, 'index']);
    Route::post('jadwal-ronda', [JadwalRondaController::class, 'store']);
    Route::get('jadwal-ronda/{jadwal_ronda}', [JadwalRondaController::class, 'show']);
    Route::put('jadwal-ronda/{jadwal_ronda}', [JadwalRondaController::class, 'update']);
    Route::delete('jadwal-ronda/{jadwal_ronda}', [JadwalRondaController::class, 'destroy']);

    Route::get('pemasukan', [PemasukanController::class, 'index']);
    Route::post('pemasukan', [PemasukanController::class, 'store']);
    Route::get('pemasukan/{pemasukan}', [PemasukanController::class, 'show']);
    Route::put('pemasukan/{pemasukan}', [PemasukanController::class, 'update']);
    Route::delete('pemasukan/{pemasukan}', [PemasukanController::class, 'destroy']);

    Route::get('pengeluaran', [PengeluaranController::class, 'index']);
    Route::post('pengeluaran', [PengeluaranController::class, 'store']);
    Route::get('pengeluaran/{pengeluaran}', [PengeluaranController::class, 'show']);
    Route::put('pengeluaran/{pengeluaran}', [PengeluaranController::class, 'update']);
    Route::delete('pengeluaran/{pengeluaran}', [PengeluaranController::class, 'destroy']);

    // tagihan
    Route::get('tagihan', [TagihanController::class, 'index']);
    Route::post('tagihan', [TagihanController::class, 'store']);
    Route::get('tagihan/{tagihan}', [TagihanController::class, 'show']);
    Route::put('tagihan/{tagihan}', [TagihanController::class, 'update']);
    Route::delete('tagihan/{tagihan}', [TagihanController::class, 'destroy']);

});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Route::middleware(['auth:sanctum',  RoleMiddleware::class . ':admin'])->group(function () {
//     Route::get('/user', function (Request $request) {
//         return response()->json([
//             'user' => $request->user()
//         ]);
//     });
// });