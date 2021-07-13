<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([ 'prefix' => 'auth'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('social_login', [AuthController::class, 'socialLogin']);
    Route::post('forgot_password', [AuthController::class, 'forgotPasswordCode']);
    Route::post('recover_password', [AuthController::class, 'recoverPassword']);
    Route::post('verify_user', [AuthController::class, 'verifyUserWithCode']);
    Route::post('reset_password', [AuthController::class, 'recoverPassword']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth:api'], function() {

    //profile Api
    Route::post('update_user', [UserController::class, 'updateUser']);
    Route::post('delete_profile', [UserController::class, 'deleteProfile']);
    Route::post('get_user',  [UserController::class, 'getUser']);

    //service Api
    Route::post('get_service', [ServiceController::class, 'getService']);
    Route::post('updated_service', [ServiceController::class, 'updateService']);
    Route::post('delete_service', [ServiceController::class, 'deleteService']);

    //Appointment Api
    Route::post('get_appointment', [AppointmentController::class, 'getAppointment']);
    Route::post('update_appointment', [AppointmentController::class, 'updateAppointment']);
    Route::post('delete_appointment', [AppointmentController::class, 'deleteAppointment']);
    Route::post('available_appointments', [AppointmentController::class, 'availableAppointments']);
    Route::post('salon_offering', [AppointmentController::class, 'salonOff']);
});

