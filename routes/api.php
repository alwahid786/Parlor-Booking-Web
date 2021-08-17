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

Route::any('/apple', function(){
    return 'apple';
});

Route::group([ 'prefix' => 'auth'], function () {

    Route::any('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('social_login', [AuthController::class, 'socialLogin']);
    Route::post('forgot_password', [AuthController::class, 'forgotPasswordCode']);
    Route::post('recover_password', [AuthController::class, 'recoverPassword']);
    Route::post('resend_activation_token', [AuthController::class, 'resendVerificationToken']);
    Route::post('verify_user', [AuthController::class, 'verifyUserWithCode']);
    Route::post('reset_password', [AuthController::class, 'recoverPassword']);
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::post('get_salon',  [UserController::class, 'getSalon']);
Route::post('get_service', [ServiceController::class, 'getService']);

Route::group(['middleware' => 'auth:api'], function() {

    //profile Api
    Route::post('update_user', [UserController::class, 'updateUser']);
    Route::post('delete_profile', [UserController::class, 'deleteProfile']);
    Route::post('get_user',  [UserController::class, 'getUser']);
    Route::post('upload_brosche',  [UserController::class, 'uploadBrosche']);

    //service Api
    Route::post('updated_service', [ServiceController::class, 'updateService']);
    Route::post('delete_service', [ServiceController::class, 'deleteService']);

    //Appointment Api
    Route::post('get_appointment', [AppointmentController::class, 'getAppointment']);
    Route::post('update_appointment', [AppointmentController::class, 'updateAppointment']);
    Route::post('delete_appointment', [AppointmentController::class, 'deleteAppointment']);
    Route::post('available_appointments', [AppointmentController::class, 'availableAppointments']);
    Route::post('salon_offering', [AppointmentController::class, 'salonOff']);

        // Notification
    Route::post('update_notification_setting', 'App\Http\Controllers\NotificationController@updateNotificationSetting');
    Route::post('get_notifications', 'App\Http\Controllers\NotificationController@getNotifications');
    Route::post('get_notification_permissions', 'App\Http\Controllers\NotificationController@getNotificationsPermission');
    Route::post('get_unread_notification_counts', 'App\Http\Controllers\NotificationController@getUnreadNotificationsCount');
});

