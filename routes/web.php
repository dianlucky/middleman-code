<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatAdminController;
use App\Models\Conversation;

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

Route::prefix('transaction')->middleware('auth')->group(function()
{
    Route::get('/', [ChatController::class, 'index'])->name('transaction.index');

    Route::get('/room/{id?}', [ChatController::class, 'showRoom'])->name('transaction.room.show');
    Route::post('/room', [ChatController::class, 'storeRoom'])->name('transaction.room.store');
    Route::put('/room/join/{id}', [ChatController::class, 'joinRoom'])->name('transaction.room.join');
    Route::put('/room/leave/{id}', [ChatController::class, 'leaveRoom'])->name('transaction.room.leave');
    Route::delete('/room/{id}', [ChatController::class, 'destroyRoom'])->name('transaction.room.destroy');

    Route::get('/conversation/{id}', [ChatController::class, 'showConversation'])->name('transaction.conversation.show');
    Route::post('/conversation', [ChatController::class, 'storeConversation'])->name('transaction.conversation.store');
    Route::delete('/conversation/{id}', [ChatController::class, 'destroyConversation'])->name('transaction.conversation.destroy');
});

Route::post('/send-message', [ConversationController::class, 'sendMessage'])->middleware('auth');

Route::prefix('/login')->middleware('guest')->group(function(){
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/auth', [LoginController::class, 'auth']);
});

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::prefix('register')->group(function(){
    Route::get('/', [LoginController::class, 'register']);
    Route::post('/save', [LoginController::class, 'registerSave']);
});

// routes/web.php
Route::get('/search-users', [UserController::class, 'searchUsers'])->name('search.users');

Route::get('/dashboard', [AdminPageController::class, 'dashboard'])->middleware(['auth', 'is_admin']);
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminPageController::class, 'admin']);
    Route::get('/add', [UserController::class, 'adminAdd']);
    Route::post('/save', [UserController::class, 'adminInsert']);
    Route::get('/edit/{id}', [UserController::class, 'adminEdit']);
    Route::post('/update/{id}', [UserController::class, 'adminUpdate']);
    Route::delete('/delete/{id}', [UserController::class, 'adminDelete']);
});

Route::prefix('room')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [ChatAdminController::class, 'index']);
    Route::put('/{id}', [ChatAdminController::class, 'update']);
});

Route::get('/user', [UserController::class, 'index']);
