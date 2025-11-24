<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicWorkerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Public Worker Registration
Route::get('/register', [PublicWorkerController::class, 'showRegisterForm'])->name('worker.register.form');
Route::post('/worker/register', [PublicWorkerController::class, 'register'])->name('worker.register');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/{id}', [AdminController::class, 'userShow'])->name('users.show');
        Route::get('/users/{id}/edit', [AdminController::class, 'userEdit'])->name('users.edit');
        Route::post('/users/{id}', [AdminController::class, 'userUpdate'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'userDelete'])->name('users.delete');

        // Workers
        Route::get('/workers', [AdminController::class, 'workers'])->name('workers');
        Route::get('/workers/create', [AdminController::class, 'workerCreate'])->name('workers.create');
        Route::post('/workers', [AdminController::class, 'workerStore'])->name('workers.store');
        Route::get('/workers/{id}', [AdminController::class, 'workerShow'])->name('workers.show');
        Route::get('/workers/{id}/edit', [AdminController::class, 'workerEdit'])->name('workers.edit');
        Route::post('/workers/{id}', [AdminController::class, 'workerUpdate'])->name('workers.update');
        Route::delete('/workers/{id}', [AdminController::class, 'workerDelete'])->name('workers.delete');

        // Orders
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}', [AdminController::class, 'orderShow'])->name('orders.show');
        Route::delete('/orders/{id}', [AdminController::class, 'orderDelete'])->name('orders.delete');

        // Schedules
        Route::get('/workers/{workerId}/schedules', [AdminController::class, 'schedules'])->name('schedules');
        Route::post('/schedules/{id}/toggle', [AdminController::class, 'scheduleToggle'])->name('schedules.toggle');
    });
});