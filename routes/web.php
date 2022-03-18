<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DatabaseController;

use App\Http\Controllers\Management\UserController;

use App\Http\Controllers\Management\RoleController;
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


// Get the current app locale
$locale = app()->getLocale();
Carbon::setLocale($locale);

// Create a date object
$date = Carbon::now();
setlocale(LC_TIME, app()->getLocale());
Carbon::setLocale('de');

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
});

Route::group(['middleware' => ['auth']], function () {
    Route::controller(GroupsController::class)->group(function () {
        // Route::resource('groups');

        Route::resource('groups', GroupsController::class);

        Route::get('/Gruppen', 'index')->name('groups');
        Route::get('/Gruppen/Hinzufügen', 'create')->name('groups.create');
        Route::get('/Gruppen/Bearbeiten/{alias}', 'edit')->name('groups.edit');
        Route::get('/Gruppen/Anzeigen/{alias}', 'show')->name('groups.show');

        Route::post('/Gruppen/Hinzufügen', 'store')->name('groups.store');
        Route::patch('/Gruppen/Bearbeiten/{alias}', 'update')->name('groups.update');
        Route::delete('/Gruppen/Bearbeiten/{alias}', 'destroy')->name('groups.destroy');
    });
});


Route::group(['middleware' => ['auth']], function () {
    Route::resource('settings', SettingsController::class);

    Route::controller(SettingsController::class)->group(function () {
        Route::get('/einstellungen', 'index')->name('settings');
        Route::patch('/einstellungen', 'update')->name('settings.update');
    });
});



Route::group(['middleware' => ['auth']], function () {

    // Route::controller(DatabaseController::class, [
    //     'make_backup' => 'database.backup',
    // ]);

    Route::resource('database', DatabaseController::class);

    Route::controller(DatabaseController::class, [
        'make_backup' => 'database.backup',
    ])
    ->group(function () {
        Route::get('/Datenbank', 'index')->name('database');
        // Route::patch('/Datenbank', 'backup')->name('database.backup');
        Route::post('/Datenbank', 'store')->name('database.store');
        Route::patch('/Datenbank', 'update')->name('database.update');
        Route::delete('/Datenbank', 'database')->name('database.destroy');
    });
});



Route::group(['middleware' => ['auth', 'role:administrator']], function () {
    Route::resource('roles', RoleController::class);

    Route::controller(RoleController::class)->group(function () {
        Route::get('Rollen', 'index')->name('roles');
        Route::get('Rolle/Hinzufügen', 'create')->name('roles.create');
        Route::get('Rolle/{id}/{role}', 'show')->name('roles.show');
        Route::get('Rolle/{id}/{role}/Bearbeiten', 'edit')->name('roles.edit');
    });
});

Route::group(['middleware' => ['auth', 'role:administrator']], function () {
    Route::resource('users', UserController::class);

    Route::controller(UserController::class)->group(function () {
        Route::get('Benutzer', 'index')->name('users');
        Route::get('Benutzer/Hinzufügen', 'create')->name('users.create');
        Route::get('Benutzer/{id}/{role}', 'show')->name('users.show');
        Route::get('Benutzer/{id}/{role}/Bearbeiten', 'edit')->name('users.edit');
    });
});
