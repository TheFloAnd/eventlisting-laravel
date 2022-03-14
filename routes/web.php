<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DatabaseController;
use Carbon\Carbon;

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
// Create a date object
$date = Carbon::now();

// Get the current app locale
$locale = app()->getLocale();
Carbon::setLocale($locale);

Auth::routes();
Route::controller(HomeController::class)->group(function () {
    // Route::resource('home');
    Route::get('/', 'index')->name('home');
    Route::get('/home', 'index')->name('home');
});


Route::group(['middleware' => ['auth']], function () {

    Route::controller(EventsController::class)->group(function () {

        Route::get('/Termine', 'index')->name('events');
        Route::get('/Termine/Hinzufügen', 'create')->name('events.create');
        Route::get('/Termine/Bearbeiten/{id}', 'edit')->name('events.edit');
        // Route::get('/Termine/Anzeigen/{id}', 'show')->name('events.show');

        Route::post('/Termine/Hinzufügen', 'store')->name('events.store');
        Route::patch('/Termine/Bearbeiten/{id}', 'update')->name('events.update');
        Route::delete('/Termine/Bearbeiten/{id}', 'destroy')->name('events.destroy');
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
});


Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::resource('settings', SettingsController::class);

    Route::controller(SettingsController::class)->group(function () {
        Route::get('/einstellungen', 'index')->name('settings');
        Route::patch('/einstellungen', 'update')->name('settings.update');
    });
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::resource('database', DatabaseController::class);

    Route::controller(DatabaseController::class)->group(function () {
        Route::get('/Datenbank', 'index')->name('database');
        Route::patch('/Datenbank', 'update')->name('database.update');
        Route::delete('/Datenbank', 'database')->name('database.destroy');
    });
});
