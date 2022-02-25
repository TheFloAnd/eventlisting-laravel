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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('settings', App\Http\Controllers\SettingsController::class);
    Route::get('/einstellungen', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');


    Route::resource('events', App\Http\Controllers\EventsController::class);
    Route::get('/Termine', [App\Http\Controllers\EventsController::class, 'index'])->name('events.index');
    Route::get('/Termine/Hinzufügen', [App\Http\Controllers\EventsController::class, 'create'])->name('events.create');
    Route::get('/Termine/Bearbeiten/{id}', [App\Http\Controllers\EventsController::class, 'edit'])->name('events.edit');

    Route::resource('groups', App\Http\Controllers\GroupsController::class);
    Route::get('/Gruppen', [App\Http\Controllers\GroupsController::class, 'index'])->name('groups.index');
    Route::get('/Gruppen/Hinzufügen', [App\Http\Controllers\GroupsController::class, 'create'])->name('groups.create');
    Route::get('/Gruppen/Bearbeiten/{alias}', [App\Http\Controllers\GroupsController::class, 'edit'])->name('groups.edit');
});
