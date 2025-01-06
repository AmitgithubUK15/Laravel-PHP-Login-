<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cookie;
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
                return redirect()->route('login')->with([
                    'error' => 'Invalid email'
                ]);
            }
            
            if(!$password){
                return redirect()->route('login')->with([
                    'error'=> 'Invalid password'
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


    public function Sessionfunction($email,Response $response){
    session(['useremail'=>$email]);
    

    $cookie = cookie('user',encrypt(env('AUTH_COOKIE')), 120);
    return redirect('/')
        ->withCookie($cookie)
        ->with('success', 'Session created successfully!');
    }
}


// $content = 'Hello again, cookie!'; // Your desired content

    // // Attach a cookie using the facade
    // // return response($content)->withCookie('my_cookie', 'oatmeal_raisin', 120);
    // return response('Hello World')->cookie(
    //     'name', 'value', 1
    // );

    //   redirect()->route('home');
