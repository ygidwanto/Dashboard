<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::post('/dokumen', [App\Http\Controllers\DashboardController::class, 'store'])->name('dokumen.store');
Route::delete('/dokumen/{id}', [App\Http\Controllers\DashboardController::class, 'destroy'])->name('dokumen.destroy');
Route::put('/dokumen/{id}', [App\Http\Controllers\DashboardController::class, 'update'])->name('dokumen.update');

