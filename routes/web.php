<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Plugins
    Route::get('/plugins', [\App\Http\Controllers\AdminController::class, 'plugins'])->name('plugins.index');
    Route::get('/plugins/create', [\App\Http\Controllers\AdminController::class, 'createPlugin'])->name('plugins.create');
    Route::post('/plugins', [\App\Http\Controllers\AdminController::class, 'storePlugin'])->name('plugins.store');
    
    // Licenses
    Route::get('/licenses', [\App\Http\Controllers\AdminController::class, 'licenses'])->name('licenses.index');
    Route::post('/licenses/{id}/revoke', [\App\Http\Controllers\AdminController::class, 'revokeLicense'])->name('licenses.revoke');
});
