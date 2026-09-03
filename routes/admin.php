<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MerchantsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\SettingsController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Merchants CRUD
    Route::prefix('merchants')->name('merchant.')->group(function () {
        Route::get('/', [MerchantsController::class, 'index'])->name('list');
        Route::get('/create', [MerchantsController::class, 'create'])->name('create');
        Route::post('/store', [MerchantsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MerchantsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [MerchantsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MerchantsController::class, 'destroy'])->name('destroy');
    });

    // Products CRUD
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('list');
        Route::get('/create', [ProductsController::class, 'create'])->name('create');
        Route::post('/store', [ProductsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ProductsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ProductsController::class, 'destroy'])->name('destroy');
    });

    // Orders management
    Route::prefix('orders')->name('order.')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('list');
        Route::get('/{order}/edit', [OrdersController::class, 'edit'])->name('edit');
        Route::put('/{order}', [OrdersController::class, 'update'])->name('update');
        Route::delete('/{order}', [OrdersController::class, 'destroy'])->name('destroy');
    });

    // Projects CRUD
    Route::prefix('projects')->name('project.')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('list');
        Route::get('/create', [ProjectsController::class, 'create'])->name('create');
        Route::post('/store', [ProjectsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ProjectsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ProjectsController::class, 'destroy'])->name('destroy');

        // Tasks under projects
        Route::prefix('{project}/tasks')->name('tasks.')->group(function () {
            Route::get('/', [TasksController::class, 'index'])->name('index');
            Route::get('/create', [TasksController::class, 'create'])->name('create');
            Route::post('/store', [TasksController::class, 'store'])->name('store');
            Route::get('/{task}/edit', [TasksController::class, 'edit'])->name('edit');
            Route::put('/{task}/update', [TasksController::class, 'update'])->name('update');
            Route::delete('/{task}/destroy', [TasksController::class, 'destroy'])->name('destroy');
        });
    });

    // General Tasks
    Route::get('tasks', [TasksController::class, 'generalIndex'])->name('tasks.index');

});

