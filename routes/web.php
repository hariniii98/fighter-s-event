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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/** Settings */
Route::prefix('settings')->group(function () {

    Route::get('/index', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/store', [App\Http\Controllers\SettingsController::class, 'store'])->name('settings.store');
});

Route::prefix('event_categories')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showEventCategories'])->name('event_categories.index');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'store'])->name('event_categories.store');
});


Route::prefix('roles')->group(function () {

    Route::get('/index', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');

});


