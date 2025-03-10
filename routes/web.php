<?php

use App\Http\Controllers\AdminController;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/',[LandingPageController::class,'index'])->name('home');
Route::get('/categories/{categories_id}',[LandingPageController::class,'show']);

Route::middleware(['auth','verified.admin'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('finance', FinanceController::class);
    Route::resource('detail', DetailTransactionController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('admin', AdminController::class);
    Route::post('/transactions/{id}/ship', [TransactionController::class, 'ship']);
    Route::post('/transactions/{id}/cancel', [TransactionController::class, 'cancel']);
});

Route::resource('preview',PreviewController::class);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cart', CartController::class);
    Route::resource('transaction', TransactionController::class);
    Route::put('bayar/{code}', [TransactionController::class, 'update']);
    Route::resource('order', OrderController::class);
    Route::resource(' delivery', DeliveryController::class);
    Route::put('/order/{id}/complete', [OrderController::class, 'markAsDelivered']);

    Route::post('/pay/{transactionId}', [PaymentController::class, 'pay'])->name('pay.transaction');
    Route::post('/midtrans-callback', [PaymentController::class, 'callback'])->name('midtrans.callback');
    Route::post('/get-payment-token/{code}', [PaymentController::class, 'getPaymentToken'])->name('payment.token');
});

require __DIR__.'/auth.php';
