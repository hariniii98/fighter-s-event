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
Route::get('{role}/register',[App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('role.register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/** Settings */
Route::prefix('settings')->group(function () {

    Route::get('/index', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/store', [App\Http\Controllers\SettingsController::class, 'store'])->name('settings.store');
});

Route::prefix('event_categories')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showEventCategories'])->name('event_categories.index');
    Route::get('/create', [App\Http\Controllers\EventController::class, 'addEventCategory'])->name('event_category.create');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'storeEventCategory'])->name('event_category.store');
    Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteEventCategory'])->name('event_category.delete');
});

Route::prefix('allowances')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showAllowances'])->name('allowances.index');
    Route::get('/create', [App\Http\Controllers\EventController::class, 'addAllowance'])->name('allowance.create');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'storeAllowance'])->name('allowance.store');
    Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteAllowance'])->name('allowance.delete');
});

Route::prefix('age_categories')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showAgeCategories'])->name('age_categories.index');
    Route::get('/create', [App\Http\Controllers\EventController::class, 'addAgeCategory'])->name('age_category.create');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'storeAgeCategory'])->name('age_category.store');
    Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteAgeCategory'])->name('age_category.delete');
});

Route::prefix('weight_categories')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showWeightCategories'])->name('weight_categories.index');
    Route::get('/create', [App\Http\Controllers\EventController::class, 'addWeightCategory'])->name('weight_category.create');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'storeWeightCategory'])->name('weight_category.store');
    Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteWeightCategory'])->name('weight_category.delete');
});

Route::prefix('sponsors')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showSponsors'])->name('sponsors.index');
    Route::get('/create', [App\Http\Controllers\EventController::class, 'addSponsor'])->name('sponsor.create');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'storeSponsor'])->name('sponsor.store');
    Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteSponsor'])->name('sponsor.delete');
});

Route::prefix('extra_ranking_points')->group(function () {

    Route::get('/index', [App\Http\Controllers\EventController::class, 'showExtraRankingPoints'])->name('extra_ranking_points.index');
    Route::get('/create', [App\Http\Controllers\EventController::class, 'addExtraRankingPoint'])->name('extra_ranking_point.create');
    Route::post('/store', [App\Http\Controllers\EventController::class, 'storeExtraRankingPoint'])->name('extra_ranking_points.store');
    Route::get('/delete/{id}', [App\Http\Controllers\EventController::class, 'deleteExtraRankingPoint'])->name('extra_ranking_point.delete');
});

Route::prefix('roles')->group(function () {

    Route::get('/index', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::get('/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::post('/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');

});


Route::resource('events', 'App\Http\Controllers\EventsController');
Route::post('events/update/{id}','App\Http\Controllers\EventsController@updateEvent')->name('event.update');
Route::post('/event_user/store','App\Http\Controllers\EventController@storeEventUser')->name('event_user.store');

Route::prefix('users')->group(function () {

    Route::get('/index', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');

});
Route::get('payments','App\Http\Controllers\EventController@payments')->name('payments.index');
Route::get('create_whatsapp_push_notification','App\Http\Controllers\ChannelsController@createWhatsappPushNotification');
Route::get('send_whatsapp_push_notification','App\Http\Controllers\ChannelsController@sendWhatsappPushNotification');


