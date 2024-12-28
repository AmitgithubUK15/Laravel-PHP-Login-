<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Signupfunction(Request $request)
    {
        $name = $request->input('body.name');
        $email = $request->input('body.email');
        $password = $request->input('body.password');       
       return ['name' => $name, 'email' => $email, 'password' => $password];
}
}
