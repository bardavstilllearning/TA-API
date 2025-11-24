<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-shake', [AuthController::class, 'verifyShake']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/complete-profile', [AuthController::class, 'completeProfile']);

// User Profile
Route::get('/profile', [UserController::class, 'getProfile']);
Route::post('/profile/update', [UserController::class, 'updateProfile']);
Route::post('/profile/preferences', [UserController::class, 'updatePreferences']);
Route::post('/update-password', [UserController::class, 'updatePassword']); // NEW

// Workers
Route::get('/workers', [WorkerController::class, 'index']);
Route::get('/workers/{id}', [WorkerController::class, 'show']);

// Orders
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'getUserOrders']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus']);
Route::post('/orders/{id}/confirm', [OrderController::class, 'confirmOrder']); // NEW
Route::post('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']); // NEW
Route::post('/orders/{id}/photo-before', [OrderController::class, 'uploadPhotoBefore']);
Route::post('/orders/{id}/photo-after', [OrderController::class, 'uploadPhotoAfter']);
Route::post('/orders/{id}/review', [OrderController::class, 'submitReview']);