<?php

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

Auth::routes();
Route::resource('home', App\Http\Controllers\HomeController::class);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('settings', App\Http\Controllers\SettingsController::class);
Route::get('/einstellungen', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');


Route::resource('events', App\Http\Controllers\EventsController::class);
Route::get('/termine', [App\Http\Controllers\EventsController::class, 'index'])->name('events.index');
