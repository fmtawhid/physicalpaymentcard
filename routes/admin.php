<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MerchantsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TasksController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Merchants CRUD
    Route::prefix('merchants')->name('merchant.')->group(function () {
        Route::get('/', [MerchantsController::class, 'index'])->name('list');
        Route::get('/create', [MerchantsController::class, 'create'])->name('create');
        Route::post('/store', [MerchantsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MerchantsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [MerchantsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MerchantsController::class, 'destroy'])->name('destroy');
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

