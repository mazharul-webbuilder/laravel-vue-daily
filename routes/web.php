<?php

use App\Http\Controllers\LoginWithSocial\LoginWithGoogleController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\API\Implement\ApiController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('auth')->group(function (){
   Route::post('/login', LoginController::class)->middleware('guest');
   Route::post('/register', RegisterController::class)->middleware('guest');
   Route::post('/logout', LogoutController::class);
});

Route::get('get-countries-api-data', [ApiController::class, 'getCountriesApiData']);


Route::controller(LoginWithGoogleController::class)->group(function(){
    Route::get('login-with-google', 'loginView');
    Route::get('authorized/google', 'redirectToGoogle')->name('auth.google');
    Route::get('authorized/google/callback', 'handleGoogleCallback');
});
