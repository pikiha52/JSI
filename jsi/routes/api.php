<?php

use App\Http\Controllers\Api\Algoritme\FibonacciController;
use App\Http\Controllers\Api\Algoritme\SubstringController;
use App\Http\Controllers\Api\Algoritme\UserRecursiveController;
use App\Http\Controllers\Api\Modules\BookController;
use App\Http\Controllers\Api\Modules\BorrowController;
use App\Http\Controllers\Api\Modules\DashboardController;
use App\Http\Controllers\Api\Modules\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::post('/recursive', [UserRecursiveController::class, 'index']);
Route::post('/fibonacci', [FibonacciController::class, 'index']);
Route::post('/substring', [SubstringController::class, 'index']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'delete']);

Route::get('/books', [BookController::class, 'index']);
Route::post('/book', [BookController::class, 'store']);
Route::get('/book/{id}', [BookController::class, 'show']);
Route::put('/book/{id}', [BookController::class, 'update']);
Route::delete('/book/{id}', [BookController::class, 'delete']);

Route::get('/borrows', [BorrowController::class, 'index']);
Route::post('/borrow', [BorrowController::class, 'store']);
Route::get('/borrow/{id}', [BorrowController::class, 'show']);
Route::put('/borrow/{id}', [BorrowController::class, 'update']);
Route::delete('/borrow/{id}', [BorrowController::class, 'delete']);
