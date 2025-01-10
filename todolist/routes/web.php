<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('home');
Route::post('/store/task', [TodoController::class, 'store'])->name('store');
Route::get('/edit/task', [TodoController::class, 'edit'])->name('edit');
Route::post('/store/task', [TodoController::class, 'store'])->name('store');
Route::post('/delete-multi/task', [TodoController::class, 'deleteMultiple'])->name('delete.multiple');
Route::get('/search', [TodoController::class, 'search'])->name('search');


