<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// this is signup route
Route::post('/signup', [AuthController::class,'Signupfunction']);