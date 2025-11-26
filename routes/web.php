<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

// Auth routes
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
})->name('index');

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/tutorial/{id}', [UserController::class, 'show'])->name('tutorial.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/bots/create', [ProductController::class, 'create'])->name('admin.bots.create');
    Route::post('/bots/store', [ProductController::class, 'store'])->name('admin.bots.store');
    Route::get('/bots/{id}/edit', [ProductController::class, 'edit'])->name('admin.bots.edit');
    Route::put('/bots/{id}/update', [ProductController::class, 'update'])->name('admin.bots.update');
    Route::delete('/bots/{id}/delete', [ProductController::class, 'destroy'])->name('admin.bots.delete');


    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions');
    Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets');
    Route::get('/profile', [SettingController::class, 'index'])->name('admin.profile');
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::get('/logout', [SettingController::class, 'index'])->name('admin.logout');
});
