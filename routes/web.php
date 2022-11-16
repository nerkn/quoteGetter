<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Pages;

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

Route::get('/', [Pages::class, 'indexPage']);
Route::resource('/Offers', 'Offers');


Route::controller(RequestsController::class)->name('requests.')->group(function(){
  Route::get ('/requests',              'index')->name('index');
  Route::get ('/requests/create',       'create')->name('create');
  Route::get ('/requests/{id}',         'show')->name('show');
  Route::get ('/requests/{id}/Offers',  'offers')->name('offers');
  Route::get ('/requests/{id}/Invite',  'invite')->name('invite');
  Route::post('/requests',              'store')->name('store');
}
);

Route::middleware('guest')->group(function () {
  Route::post('register',               [AuthController::class, 'register'])->name('register');;
  Route::post('login',                  [AuthController::class, 'login'])->name('login');
  Route::get('forgot-password',         [PasswordResetLinkController::class, 'create'])             ->name('password.request');
  Route::post('forgot-password',        [PasswordResetLinkController::class, 'store'])              ->name('password.email');
  Route::get('reset-password/{token}',  [NewPasswordController::class, 'create'])              ->name('password.reset');
  Route::post('reset-password',         [NewPasswordController::class, 'store'])                    ->name('password.update');
});

Route::middleware('auth')->group(function () {
  Route::get('verify-email',            [AuthController::class, 'VerifyEmailController'])     ->name('verification.notice');

  Route::get('verify-email/{id}/{hash}',[AuthController::class, 'VerifyEmailController'])
              ->middleware(['signed', 'throttle:6,1'])
              ->name('verification.verify');

  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
              ->middleware('throttle:6,1')
              ->name('verification.send');

  Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
              ->name('password.confirm');

  Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

  Route::post('logout',                   [AuthController::class, 'destroy'])
              ->name('logout');
});