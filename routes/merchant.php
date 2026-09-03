<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\AdminController as MerchantDashboard;
use App\Http\Controllers\Merchant\SettingController;
use App\Http\Controllers\Merchant\ProjectsController;

Route::middleware(['auth','merchant'])->prefix('merchant')->name('merchant.')->group(function() {
    Route::get('/', [MerchantDashboard::class, 'index'])->name('index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Projects Routes
    Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/projects/{id}', [ProjectsController::class, 'show'])->name('projects.show');
    Route::post('/projects/{id}/join', [ProjectsController::class, 'join'])->name('projects.join');
    Route::post('/projects/{id}/leave', [ProjectsController::class, 'leave'])->name('projects.leave');
    Route::get('/my-projects', [ProjectsController::class, 'myProjects'])->name('projects.my');
});




