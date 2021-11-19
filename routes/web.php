<?php

use App\Helpers\EmailChangeHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Web;
use App\Models\User;
use Illuminate\Http\Request;

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

Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('/pages/dashboard/index');
    })->name('dashboard.index');

    Route::resource('profile', Web\UserControler::class);
    Route::resource('merchants', Web\MerchantController::class);
    Route::resource('members', Web\MemberController::class);

    Route::resource('events', Web\EventController::class);
    Route::post('event-test/{event}', [Web\EventController::class, 'eventTest'])->name('event-test');


    Route::post('popup-verify/{user}', function (User $user) {
        $user->isShowPopupVerify = true;
        $user->save();
    })->name('popup-verify');

    Route::get('verify-email-change', function (Request $request) {
        return EmailChangeHelper::validateToken($request->token);
    })->name('verify-email-change');
});

Route::get('/test', function () {
    return view('/test');
});

Route::view('test2', 'test2');

Route::get('/home', function () {
    return view('/home');
});

Route::get('/billing', function () {
    return view('/pages/billing/index');
});

Route::get('/billing-company', function () {
    return view('/pages/billing/billing-company');
});

Route::get('/help', function () {
    return view('/pages/help/index');
});

Route::get('/coba', function () {
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});
