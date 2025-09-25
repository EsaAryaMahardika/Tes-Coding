<?php

use App\Http\Controllers\General;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentController;

Route::get('/signin', [General::class, 'signin'])->name('login');
Route::get('/signup', [General::class, 'signup'])->name('signup');
Route::post('/signin', [General::class, 'auth']);
Route::post('/signup', [General::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/', [General::class, 'dashboard']);
    Route::get('/logout', [General::class, 'logout']);
    
    Route::get('/account', [AdminController::class, 'account']);
    Route::post('/account', [AdminController::class, 'create']);
    Route::put('/account/{id}', [AdminController::class, 'edit']);
    Route::delete('/account/{id}', [AdminController::class, 'delete']);
    
    Route::get('/content', [ContentController::class, 'content']);
    Route::post('/content', [ContentController::class, 'create']);
    Route::put('/content/{id}', [ContentController::class, 'edit']);
    Route::delete('/content/{id}', [ContentController::class, 'delete']);
});