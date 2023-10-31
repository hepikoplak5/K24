<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);
Route::post('/edit-profile', [App\Http\Controllers\HomeController::class, 'edit-profile']);
Route::post('/delete-profile', [App\Http\Controllers\HomeController::class, 'delete-profile']);

// Route::resource('/','HomeController');