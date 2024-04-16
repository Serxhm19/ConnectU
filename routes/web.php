<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController ;
use App\Http\Controllers\Api\MessagesController;


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

Route::post('login', [AuthenticatedSessionController::class, 'login']);
Route::post('loginPromoter', [AuthenticatedSessionController::class, 'loginPromoter']);
Route::post('register', [AuthenticatedSessionController::class, 'register']);
Route::post('registerPromoter', [AuthenticatedSessionController::class, 'registerPromoter']);
Route::post('logout', [AuthenticatedSessionController::class, 'logout']);


Route::get('/chats', [ChatsController::class, 'index']);
Route::get('/chats', [MessagesController::class, 'index']);
Route::post('/chats', [MessagesController::class, 'store']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::view('/{any?}', 'main-view')
    ->name('dashboard')
    ->where('any', '.*');
