<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\SettingsController;

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
Route::controller(HomeController::class)->group(function () {
    // Route::resource('home');
    Route::get('/', 'index')->name('home');
    Route::get('/home', 'index')->name('home');
});

Route::group(['middleware' => ['auth']], function () {

    Route::controller(EventsController::class)->group(function () {
        // Route::resource('events');
        Route::get('/Termine', 'index')->name('events');
        Route::get('/Termine/Hinzufügen', 'create')->name('events.create');
        Route::get('/Termine/Bearbeiten/{id}', 'edit')->name('events.edit');
        // Route::get('/Termine/Anzeigen/{id}', 'show')->name('events.show');
    });

    Route::controller(GroupsController::class)->group(function () {
        // Route::resource('groups');
        Route::get('/Gruppen', 'index')->name('groups');
        Route::get('/Gruppen/Hinzufügen', 'create')->name('groups.create');
        Route::get('/Gruppen/Bearbeiten/{alias}', 'edit')->name('groups.edit');
        Route::get('/Gruppen/Anzeigen/{alias}', 'show')->name('groups.show');

        Route::post('/Gruppen/Hinzufügen', 'store')->name('groups.store');
        Route::patch('/Gruppen/Bearbeiten/{alias}', 'update')->name('groups.update');
        Route::delete('/Gruppen/Bearbeiten/{alias}', 'destroy')->name('groups.destroy');
    });

    Route::controller(SettingsController::class)->group(function () {
        // Route::resource('settings');
        Route::get('/einstellungen', 'index')->name('settings');
    });
});
