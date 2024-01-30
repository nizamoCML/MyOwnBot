<?php

use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\FrontSessionController;
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
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'front-session', 'as' => 'front-session.'], function () {
    Route::post('/send-session', [FrontSessionController::class, 'sendSession'])->name('send-session');
});

Route::group(['prefix' => 'chat-bot', 'as' => 'chat-bot.'], function () {
    Route::get('/chat/{session_id}', [ChatbotController::class, 'chat'])->name('chat');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
