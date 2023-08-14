<?php
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterPelangganController;

Route::middleware('guest')->group(function () {
  Route::get('register', [RegisterPelangganController::class, 'create'])
  ->name('register');
  Route::post('register', [RegisterPelangganController::class, 'store'])->name('register.store');

  Route::get('login', [AuthController::class, 'create']);

  Route::post('login', [AuthController::class, 'store'])->name('login');
});

Route::middleware('auth:admin,pelanggan')->group(function () {
  Route::post('logout', [AuthController::class, 'destroy'])
              ->name('logout');
});