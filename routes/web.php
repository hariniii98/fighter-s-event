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
    return redirect(route('login'));
});

Route::get('check_role','App\Http\Controllers\Auth\RegisterController@checkRole')->name('role.check');

Auth::routes();
Route::get('{role}/register',[App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('role.register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/city/ajax','App\Http\Controllers\Auth\RegisterController@searchCity')->name('city.ajax');
Route::get('card/{id}','App\Http\Controllers\EventController@getIdCard')->name('user.id_card');
/** Settings */
Route::group(['middleware' => ['auth','role:admin|manager']], function () {


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

Route::get('/events/fighters/{id}','App\Http\Controllers\EventController@showFighters')->name('event.fighters');
Route::get('/events/fighters/profile/{id}','App\Http\Controllers\EventController@showFightersProfile')->name('event.fighters.profile');
Route::get('/judges','App\Http\Controllers\EventController@showAllJudges')->name('event.judges');
Route::get('events/judge/edit/{id}','App\Http\Controllers\EventController@editJudge')->name('judge.edit');
Route::post('events/judge/store/{id}','App\Http\Controllers\EventController@storeJudgeEventRing')->name('judge_event_ring.store');

Route::get('/super_judges','App\Http\Controllers\EventController@showAllSuperJudges')->name('event.super_judges');
Route::get('events/super_judge/edit/{id}','App\Http\Controllers\EventController@editSuperJudge')->name('super_judge.edit');
Route::post('events/super_judge/store/{id}','App\Http\Controllers\EventController@storeSuperJudgeEventRing')->name('super_judge_event_ring.store');

Route::get('/referees','App\Http\Controllers\EventController@showAllReferees')->name('event.referees');
Route::get('events/referee/edit/{id}','App\Http\Controllers\EventController@editReferee')->name('referee.edit');
Route::post('events/referee/store/{id}','App\Http\Controllers\EventController@storeRefereeEventRing')->name('referee_event_ring.store');

Route::post('events/rings/ajax','App\Http\Controllers\EventController@checkEventRings')->name('event.rings');

Route::prefix('users')->group(function () {

    Route::get('/index', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');

});
Route::get('payments','App\Http\Controllers\EventController@payments')->name('payments.index');
Route::get('payments/edit/{id}','App\Http\Controllers\EventController@paymentsEdit')->name('payments.edit');
Route::post('payments/update/{id}','App\Http\Controllers\EventController@paymentUpdate')->name('payment.update');
Route::get('create_whatsapp_push_notification','App\Http\Controllers\EventController@createWhatsappPushNotification')->name('whatsapp_push_notification.create');
Route::post('send_whatsapp_push_notification','App\Http\Controllers\EventController@sendWhatsappPushNotification')->name('whatsapp_push_notification.send');

Route::get('/draw', [App\Http\Controllers\TournamentDrawController::class, 'draw'])->name('tournament.draws');
Route::post('draws/store', [App\Http\Controllers\TournamentDrawController::class, 'store'])->name('tournament.draws.store');
Route::get('matches/list', [App\Http\Controllers\TournamentDrawController::class, 'matchesList'])->name('tournament.matches.list');
Route::get('matches/create', [App\Http\Controllers\TournamentDrawController::class, 'matchesCreate'])->name('tournament.matches.create');
Route::post('matches/store', [App\Http\Controllers\TournamentDrawController::class, 'matchesStore'])->name('tournament.matches.store');
Route::get('matches/edit/{draw_id}/{match_id}', [App\Http\Controllers\TournamentDrawController::class, 'matchesEdit'])->name('tournament.matches.edit');
Route::post('matches/update/{id}', [App\Http\Controllers\TournamentDrawController::class, 'matchesUpdate'])->name('tournament.matches.update');
Route::post('matches/direct_pass', [App\Http\Controllers\TournamentDrawController::class, 'matchesDirectPass'])->name('tournament.matches.direct_pass');
Route::get('matches/redraw/{event_id}/{stage_id}', [App\Http\Controllers\TournamentDrawController::class, 'matchesRedraw'])->name('tournament.matches.redraw');

Route::post('stage/search', [App\Http\Controllers\TournamentDrawController::class, 'stageSearch'])->name('stage.search');
Route::post('matches/auto_increment', [App\Http\Controllers\TournamentDrawController::class, 'matchNoAutoIncreament'])->name('tournament.matches.auto-increment');

Route::get('matches/assing_rings/{stage_id}/{match_id}/{event_id}', [App\Http\Controllers\TournamentDrawController::class, 'matchesAssignToRings'])->name('tournament.matches.assign_ring');
Route::post('matches/assing_rings/store', [App\Http\Controllers\TournamentDrawController::class, 'storeMatchesAssignToRings'])->name('tournament.matches.assign_ring.store');

Route::get('/main_events','App\Http\Controllers\EventController@showMainEvents')->name('main_events.index');
Route::post('/main_events/store','App\Http\Controllers\EventController@storeMainEvent')->name('main_events.store');
Route::get('/main_events/create','App\Http\Controllers\EventController@createMainEvent')->name('main_events.create');
Route::get('/main_events/edit/{id}','App\Http\Controllers\EventController@editMainEvent')->name('main_events.edit');
Route::post('/main_events/update/{id}','App\Http\Controllers\EventController@updateMainEvent')->name('main_events.update');
});

Route::post('/event_user/store','App\Http\Controllers\EventController@storeEventUser')->name('event_user.store');

Route::group(['middleware' => ['auth','role:fighter']], function () {
    Route::get('tournament_instructions','App\Http\Controllers\EventController@showFighterInstructions')->name('fighter.instructions');
});


Route::prefix('scores')->group(function () {

    Route::post('/store', [App\Http\Controllers\ScoreController::class, 'store'])->name('scores.store');

});
Route::prefix('super_judge_d')->group(function () {

    Route::post('/store', [App\Http\Controllers\SuperJudgeDecisionController::class, 'store'])->name('super_judge_d.store');


});
Route::get('/direct_pass/{event_id}/{stage_id}', [App\Http\Controllers\TournamentDrawController::class, 'directPassPage'])->name('tournament.direct_pass');
Route::get('player/rankings', [App\Http\Controllers\SuperJudgeDecisionController::class, 'rankings'])->name('player.rankings');

