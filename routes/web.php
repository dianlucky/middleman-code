<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomepageController::class, 'homepage']);
Route::get('/about', [HomepageController::class, 'about']);
Route::get('/price', [HomepageController::class, 'price']);
Route::get('/testimonial', [HomepageController::class, 'testimonial']);
Route::get('/contact', action: [HomepageController::class, 'contact']);
Route::get('/transaction', action: [HomepageController::class, 'transaction']);

Route::prefix('/login')->group(function(){
    Route::get('/', [LoginController::class, 'login']);
    Route::post('/auth', [LoginController::class, 'auth']);
});

Route::prefix('register')->group(function(){
    Route::get('/', [LoginController::class, 'register']);
    Route::post('/save', [LoginController::class, 'registerSave']);
});

// routes/web.php
Route::get('/search-users', [UserController::class, 'searchUsers'])->name('search.users');


Route::get('/dashboard', [AdminPageController::class, 'dashboard']);
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminPageController::class, 'admin']);
    Route::get('/add', [UserController::class, 'adminAdd']);
    Route::post('/save', [UserController::class, 'adminInsert']);
    Route::get('/edit/{id}', [UserController::class, 'adminEdit']);
    Route::post('/update/{id}', [UserController::class, 'adminUpdate']);
    Route::delete('/delete/{id}', [UserController::class, 'adminDelete']);
});


Route::get('/user', [UserController::class, 'index']);
