<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

// autentikasi
Route::post('/login', [AuthController::class, 'login']);

// Group Admin
Route::middleware(['auth:sanctum',  RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/getuser', [UserController::class, 'index']);

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
