<?php

use App\Models\User;
use App\Http\Controllers as Web;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

require __DIR__.'/auth.php';

Route::redirect('/', '/login');

Route::get('/payments-gateways/{order_id}', [Web\PaymentController::class, 'index'])->name('payments-gateways.index');
Route::post('/payments/{order_id}/{gateway_id}', [Web\PaymentController::class, 'payment'])->name('payments-gateways.payment');
Route::get('/payment/success', [Web\PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed', [Web\PaymentController::class, 'failed'])->name('payment.failed');
Route::post('ssl-commerz/payment/success', [Web\PaymentController::class, 'sslCommerzSuccess']);
Route::post('ssl-commerz/payment/failed', [Web\PaymentController::class, 'sslCommerzFailed']);
Route::get('/order-status', [Web\PaymentController::class, 'orderStatus'])->name('order.status');

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return back()->with('success', __('Cache has been cleared.'));
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'Migrated';
});
