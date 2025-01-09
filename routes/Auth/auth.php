<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;



// for page route
Route::get('/signup', function (){
   return  view('auth.Signup');
});

Route::view('/login', 'auth.login')->name('login');



// for api route
Route::post('/SignupApi',[AuthController::class,'Signupfunction']);
Route::post('/Signin',[AuthController::class, 'SigninFunction']);
Route::post('/logout',[AuthController::class, 'SignoutFunction']);
// ->middleware([CheckLoginMiddleware::class]);
// -

Route::get('/getusercookie/{userid}',[AuthController::class,'getCookieFromMap']);

// create session route
Route::get('/createsession/{userid}',[AuthController::class, 'Sessionfunction'])->name('createsession');
