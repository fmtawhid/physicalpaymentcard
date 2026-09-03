<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\AdminController as MerchantDashboard;
use App\Http\Controllers\Merchant\SettingController;

Route::middleware(['auth','merchant'])->prefix('merchant')->name('merchant.')->group(function() {
    Route::get('/', [MerchantDashboard::class, 'index'])->name('index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

  });




