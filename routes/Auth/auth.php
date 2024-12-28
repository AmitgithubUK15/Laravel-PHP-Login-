<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// this is signup route
Route::get('/signup', [AuthController::class,'Signupfunction']);