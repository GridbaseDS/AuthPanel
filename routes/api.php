<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/licenses')->group(function () {
    Route::post('auto-register', [\App\Http\Controllers\Api\LicenseController::class, 'autoRegister']);
    Route::post('activate', [\App\Http\Controllers\Api\LicenseController::class, 'activate']);
    Route::post('verify', [\App\Http\Controllers\Api\LicenseController::class, 'verify']);
    Route::post('deactivate', [\App\Http\Controllers\Api\LicenseController::class, 'deactivate']);
    Route::post('ui/render', [\App\Http\Controllers\Api\LicenseController::class, 'renderUi']);
});
