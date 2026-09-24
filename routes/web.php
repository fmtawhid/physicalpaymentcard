<?php


use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\LegalPagesController;

Route::get('/privacy-policy', [LegalPagesController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms-of-service', [LegalPagesController::class, 'terms'])->name('legal.terms');
Route::get('/refund-policy', [LegalPagesController::class, 'refund'])->name('legal.refund');

Route::get('/', function () {
    $products = Product::where('status', 'active')
        ->orderBy('sort_order')
        ->orderByDesc('id')
        ->get();

    return view('templates.welcome', compact('products'));
})->name('home');

require __DIR__.'/auth.php';
Route::get('/orders/create', [OrdersController::class, 'createDefault'])->name('orders.create.default');
Route::get('/orders/create/{product}', [OrdersController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/my-card', [OrdersController::class, 'cards'])->name('cards.index');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
});
require __DIR__.'/merchant.php';
require __DIR__.'/admin.php';
