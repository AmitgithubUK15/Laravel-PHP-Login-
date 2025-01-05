<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function Signupfunction(Request $request)
    {
        try {
            $student = new User();
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->password = Hash::make($request->input('password'));
            $student->save();

            if ($student) {
                session(['roll'=>'create']);
                return redirect()->route('auth.login');
                //    response()->json([
                //     'message' => 'Student created successfully'
                //    ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], status: 500);
        }
    }

    public function SigninFunction(Request $request)
    {
        
        try {
            $email = $request->input('email');
            $user = User::where('email',$email)->first();
            $password = Hash::check($request->input('password'),$user->password);
            
            if(!$user){
                return response()->json([
                    'message' => 'Invalid email'
                ]);
            }
            
            if(!$password){
                return response()->json([
                    'message'=> 'Invalid password'
                ]);
            }
        
            if($user && $password){
              return  redirect()->route('createsession',['email'=>$user->email]);
            }
        }
        catch (Exception $e) {
           return response()->json([
            'error' => $e->getMessage()
           ],status:500);
        }
    }


    public function Sessionfunction($email){
    session(['useremail'=>$email]);
    return redirect()->route('home');
    }
}

