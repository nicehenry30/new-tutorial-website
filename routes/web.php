<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubscriptionController;

// Auth routes
require __DIR__.'/auth.php';

Route::get('/', function () {
    $settings = App\Models\Setting::first();
    $courses = App\Models\Course::all();
    $bots = App\Models\Bot::all();
    $signals = App\Models\Signal::all();

    return view('index')->with(compact('settings', 'courses', 'bots', 'signals'));
})->name('index');

Route::get('/courses', function () {
    $settings = App\Models\Setting::first();
    $courses = App\Models\Course::all();

    return view('courses')->with(compact('settings', 'courses'));
})->name('courses');

// User routes
Route::prefix('/user')->middleware(['auth'])->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    
    
    Route::get('/checkout', [CheckoutController::class, 'showCheckout']);
    Route::post('/checkout/pay', [CheckoutController::class, 'initiatePayment'])->name('pay');
    Route::get('/payment/callback', [CheckoutController::class, 'handleCallback']);

     Route::post('/subscribe/pay/{signal}', [SubscriptionController::class, 'pay_signal']);
    Route::get('/subscribe/success', [SubscriptionController::class, 'success'])->name('subscribe.success');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');

    // Products - Bots
    Route::get('/bots/create', [ProductController::class, 'create_bot'])->name('admin.bots.create');
    Route::post('/bots/store', [ProductController::class, 'store_bot'])->name('admin.bots.store');
    Route::get('/bots/{id}/edit', [ProductController::class, 'edit_bot'])->name('admin.bots.edit');
    Route::put('/bots/{id}/update', [ProductController::class, 'update_bot'])->name('admin.bots.update');
    Route::delete('/bots/{id}/delete', [ProductController::class, 'destroy_bot'])->name('admin.bots.delete');

    // Products - Courses
    Route::get('/courses/create', [ProductController::class, 'create_course'])->name('admin.courses.create');
    Route::post('/courses/store', [ProductController::class, 'store_course'])->name('admin.courses.store');
    Route::get('/courses/{id}/edit', [ProductController::class, 'edit_course'])->name('admin.courses.edit');
    Route::put('/courses/{id}/update', [ProductController::class, 'update_course'])->name('admin.courses.update');
    Route::delete('/courses/{id}/delete', [ProductController::class, 'destroy_course'])->name('admin.courses.delete');

        // Products - Signals
    Route::get('/signals/create', [ProductController::class, 'create_signal'])->name('admin.signals.create');
    Route::post('/signals/store', [ProductController::class, 'store_signal'])->name('admin.signals.store');
    Route::get('/signals/{id}/edit', [ProductController::class, 'edit_signal'])->name('admin.signals.edit');
    Route::put('/signals/{id}/update', [ProductController::class, 'update_signal'])->name('admin.signals.update');
    Route::delete('/signals/{id}/delete', [ProductController::class, 'destroy_signal'])->name('admin.signals.delete');


    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions');
    Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets');
    Route::get('/profile', [SettingController::class, 'index'])->name('admin.profile');

    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/password', [ProfileController::class, 'update_password'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/logout', [SettingController::class, 'index'])->name('admin.logout');
});
