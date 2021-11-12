<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\EventController;

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

// USER PUBLIC APIs

Route::post('/user/register', [AuthController::class, 'userRegister']);
Route::post('/user/login', [AuthController::class, 'login']);

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Resend link to verify email
Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return ['message', 'Verification link sent!'];
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

Route::post('/user/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::post('/user/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.reset');

// USER PROTECTED APIs
Route::resource('events', EventController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // EVENT PROTECTED APIs


    Route::post('/logout', [AuthController::class, 'logout']);

});
