<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/DTuser', [App\Http\Controllers\HomeController::class, 'datauser'])->name('DTuser');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index2'])->name('home');

Route::post('/regis', [App\Http\Controllers\UserController::class, 'register'])->name('regis');

Route::post('/edit', [App\Http\Controllers\HomeController::class, 'update1']);

Route::post('/password', [App\Http\Controllers\HomeController::class, 'pass1']);

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/profile/{id}', [App\Http\Controllers\HomeController::class, 'profile']);
	Route::post('/edit-user', [App\Http\Controllers\HomeController::class, 'update']);
	Route::post('/pass', [App\Http\Controllers\HomeController::class, 'pass']);
	Route::get('/delete-user/{id}', [App\Http\Controllers\HomeController::class, 'destroy']);
});
