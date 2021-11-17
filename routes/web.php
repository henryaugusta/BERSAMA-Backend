<?php

use Illuminate\Support\Facades\Redirect;
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

Route::get('/landing', function () {
    return view('index');
})->name('landing');

Route::redirect('/', '/landing');

Route::get('/event', [App\Http\Controllers\LandingController::class, 'listevent'])->name('event');
Route::get('/donatur', [App\Http\Controllers\LandingController::class, 'donatur'])->name('donatur');
Route::get('/expenses', [App\Http\Controllers\LandingController::class, 'expenses'])->name('expenses');


Route::view('/template/home', 'template');

Auth::routes();


Route::get('/registerz', 'CustomAuthController@register');

Route::get('/artisan/dropDonasi', 'ArtisanController@dropDonasi');
Route::get('/artisan/drop', 'ArtisanController@drop');


Route::post('/register', 'StaffController@store');
Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'user']);
    Route::get('/staff', [App\Http\Controllers\HomeController::class, 'index']);


    Route::prefix('news')->group(function () {
        $cr = "NewsController";
        Route::get('create', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@viewUpdate");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('manage', "$cr@viewManage");
    });

    Route::prefix('payment-merchant')->group(function () {
        $cr = "PaymentMerchantController";
        Route::get('tambah', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@viewUpdate");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('{id}/destroy', "$cr@destroy");
        Route::get('manage', "$cr@viewManage");
    });

    Route::prefix('donation-account')->group(function () {
        $cr = "DonationAccountController";
        Route::get('tambah', "$cr@viewCreate");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@edit");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('{id}/destroy', "$cr@destroy");
        Route::get('manage', "$cr@viewManage");
    });

    Route::prefix('donasi')->group(function () {
        $cr = "DonasiController";
        Route::get('ikut-donasi', "$cr@viewIkutDonasi");

        Route::post('ikut-donasi/store', "$cr@store");
        Route::get('donasi-saya', "$cr@myDonation");
        Route::get('all', "$cr@all");

        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@edit");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('{id}/destroy', "$cr@destroy");
        Route::get('manage', "$cr@viewManage");
    });

    $UEMapping = "UserEventMappingController";
    Route::post('register_to_event', "$UEMapping@registerToEvent");


    Route::prefix('makan-gratis')->group(function () {

        $cr = "EatEventController";
        $UEMapping = "UserEventMappingController";

        Route::get('cari', "$cr@cari");
        Route::get('my/activity', "$cr@viewMyActivity");
        Route::get('create', "$cr@create");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@edit");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/detail', "$cr@viewDetail");
        Route::post('update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::post('participants/{id}/delete', "$UEMapping@deleteParticipants");
        Route::get('participants/{id}/updateTaken', "$UEMapping@updateTaken");
        Route::get('{id}/input-offline', "$cr@viewInputOffline");
        Route::get('input-offline/{id}/destroy', "$cr@destroyInputOffline");
        Route::post('{id}/input-offline/store', "$cr@storeInputOffline");
        Route::get('{id}/destroy', "$cr@destroy");
        Route::get('manage', "$cr@viewManage");
    });


    Route::prefix('expenses')->group(function () {
        $cr = "ExpensesController";

        Route::get('my/activity', "$cr@viewMyActivity");
        Route::get('create', "$cr@create");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@edit");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/detail', "$cr@viewDetail");
        Route::post('update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('{id}/destroy', "$cr@destroy");
        Route::get('manage', "$cr@viewManage");
        Route::get('report', "$cr@viewManage");
    });

    Route::prefix('event_doc')->group(function () {
        $cr = "EventDocController";

        Route::get('my/activity', "$cr@viewMyActivity");
        Route::get('create', "$cr@create");
        Route::post('store', "$cr@store");
        Route::get('{id}/edit', "$cr@edit");
        Route::post('{id}/update', "$cr@update");
        Route::get('{id}/detail', "$cr@viewDetail");
        Route::post('update', "$cr@update");
        Route::get('{id}/delete', "$cr@delete");
        Route::get('{id}/destroy', "$cr@destroy");
        Route::get('manage', "$cr@viewManage");
        Route::get('report', "$cr@viewManage");
    });

    Route::get('/admin/user/manage', [App\Http\Controllers\StaffController::class, 'viewAdminManage']);
    Route::get('/admin/user/create', [App\Http\Controllers\StaffController::class, 'viewAdminCreate']);
    Route::prefix('user')->group(function () {
        Route::get('create', [App\Http\Controllers\StaffController::class, 'viewAdminCreate']);
        Route::get('{id}/edit', [App\Http\Controllers\StaffController::class, 'viewAdminEdit']);
        Route::post('{id}/change-photo', [App\Http\Controllers\StaffController::class, 'updateProfilePhoto']);
        Route::get('{id}/detail', [App\Http\Controllers\StaffController::class, 'viewDetail']);
        Route::post('change-password', [App\Http\Controllers\StaffController::class, 'updatePassword']);
        Route::post('store', [App\Http\Controllers\StaffController::class, 'store']);
        Route::post('update', [App\Http\Controllers\StaffController::class, 'update']);
        Route::get('{id}/delete', [App\Http\Controllers\StaffController::class, 'destroy']);
    });

});

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

