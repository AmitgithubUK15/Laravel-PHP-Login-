<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Signupfunction(Request $request)
    {
        $student = new Student();
        $student->name = $request->input('body.name');
        $student->email = $request->input('body.email');
        $student->password = Hash::make($request->input('body.password'));
        $student->save();

        if($student){
            return 'Student Id created successfully...';
        }
        else{
            return 'Opreation failed';
        }
}
}

 // $name = $request->input('body.name');
        // $email = $request->input('body.email');
        // $password = $request->input('body.password');     
        // ['name' => $name, 'email' => $email, 'password' => $password]  
