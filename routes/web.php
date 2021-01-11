<?php

use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth:sanctum'])->get('/set-password', function () {
    return view('user/set-password');
})->name('users.set-passwordView');

Route::middleware(['auth:sanctum'])->post('/set-password', [UserController::class, 'setPassword'])->name('users.set-password');

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['role:admin', 'auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/users/add', [UserController::class, 'addPost'])->name('users.add.post');

    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/edit', [UserController::class, 'editPost'])->name('users.edit.post');
});
