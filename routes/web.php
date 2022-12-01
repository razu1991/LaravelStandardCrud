<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('home');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::patch('user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('user/{type}/print', [UserController::class, 'printUser'])->name('user.print');
Route::get('/user/{id}/logs', [LogController::class, 'index'])->name('user.logs');
