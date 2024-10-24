<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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


 Route::get('/',[HomepageController::class, 'homepage']);
 Route::get('/about',[HomepageController::class, 'about']);
 Route::get('/price',[HomepageController::class, 'price']);
 Route::get('/testimonial',[HomepageController::class, 'testimonial']);
 Route::get('/contact',action: [HomepageController::class, 'contact']);
 Route::get('/transaction',action: [HomepageController::class, 'transaction']);







 Route::get('/dashboard',[AdminPageController::class, 'dashboard']); 

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminPageController::class, 'admin']);
    Route::get('/add', [UserController::class, 'adminAdd']);
});

 Route::get('/user',[UserController::class, 'index']);
 
