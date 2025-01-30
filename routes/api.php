<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserControler;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

Route::controller(UserAuthController::class)->group(function(){
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');   
});

Route::middleware(['auth:sanctum'])->group(function () {
    // User Routes
    Route::get('/user/{id}', [UserControler::class, 'show']);
    Route::get('/user/{id}/category', [UserControler::class, 'showCategories']);
    Route::get('/user/transaction', [UserControler::class, 'showTransactions']);
    Route::get('/user/{id}/transaction', [UserControler::class, 'showFilteredTransactions']);
    Route::put('/user/{id}', [UserControler::class, 'update']);
    Route::delete('/user/{id}', [UserControler::class, 'delete']);

    // Category Routes
    Route::post('/user/{user_id}/category', [CategoryController::class, 'register']);
    Route::delete('/user/{user_id}/category/{category_id}', [CategoryController::class, 'delete']);

    // Transaction Routes
    Route::post('/user/{user_id}/transaction', [TransactionController::class, 'register']);
    Route::delete('/user/{user_id}/transaction/{transaction_id}', [TransactionController::class, 'delete']);
});


