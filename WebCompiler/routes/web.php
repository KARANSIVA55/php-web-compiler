<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompilerController;

Route::get('/', [CompilerController::class, 'index'])->name('main');
Route::post('/', [CompilerController::class, 'storecode'])->name('storecode');
Route::get('/code', [CompilerController::class, 'runcode'])->name('runcode');