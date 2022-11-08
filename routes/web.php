<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestsController;
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


Route::controller(RequestsController::class)->name('requests.')->group(function(){
  Route::get ('/requests',            'index')->name('index');
  Route::get ('/requests/create',     'create')->name('create');
  Route::get ('/requests/{id}',       'show')->name('show');
  Route::post('/requests',            'store')->name('store');
}
);