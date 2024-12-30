<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// for page route
Route::get('/signup', function (){
   return  view('auth.Signup');
});

Route::view('/login', 'auth.login')->name('login');

// for api route
Route::post('/SignupApi',[AuthController::class,'Signupfunction']);


// 