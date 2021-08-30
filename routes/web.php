<?php

use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\SaloonDashboardController;
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

Route::any('/', function () {
    return view('No_Authentication.no_auth');
});

Route::any('/show', function () {
    return view('No_Authentication.no_auth');
});


Route::group(['middleware' => 'guest'],function () {

        Route::any('/signin', [AuthWebController::class, 'login'])->name('weblogin');

        Route::any('/singup',[AuthWebController::class, 'create'])->name('signup');

        Route::any('/enter-code', [AuthWebController::class, 'enterCode'])->name('enterCode');

        Route::any('/forgot-password', [AuthWebController::class, 'forgotPassword'])->name('forgotPassword');

        Route::any('/reset-password', [AuthWebController::class, 'resetPassword'])->name('resetPassword');


});


Route::group(['middleware' => 'auth'],function () {
    Route::any('/dashboard/{uuid?}', [SaloonDashboardController::class, 'dashboard'])->name('saloonDashboard');
    Route::any('/profile/{uuid}', [SaloonDashboardController::class, 'profile'])->name('profile');

    //profile setting
    Route::any('/profile-setting/{uuid}', [SaloonDashboardController::class, 'profileSetting'])->name('profileSetting');


    Route::any('/service/{uuid}', [SaloonDashboardController::class, 'service'])->name('service');
    Route::post('/add-service/{uuid}', [SaloonDashboardController::class, 'addService'])->name('addService');
    Route::any('/availability/{uuid}', [SaloonDashboardController::class, 'availability'])->name('availability');
    Route::any('/appointments/{uuid}', [SaloonDashboardController::class, 'appointments'])->name('appointments');
    Route::any('/past-appointments/{uuid}', [SaloonDashboardController::class, 'pastAppointments'])->name('pastAppointments');
    Route::any('/about-us/{uuid}', [SaloonDashboardController::class, 'aboutUs'])->name('aboutUs');

    Route::any('/accpet-appointment/{uuid}', [SaloonDashboardController::class, 'acceptAppointment'])->name('acceptAppointment');
    Route::any('/cancel-appointment/{uuid}', [SaloonDashboardController::class, 'cancelAppointment'])->name('cancelAppointment');



    Route::any('/logout', [AuthWebController::class, 'logout'])->name('logout');

});
